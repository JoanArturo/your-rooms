<?php

namespace App\Http\Controllers;

use App\Events\MessageWasSent;
use App\Events\UserJoinedARoom;
use App\Events\UserLeftARoom;
use App\Interfaces\RoomRepositoryInterface;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rooms = $this->roomRepository->getAllActiveRooms(true);

        return view('room.index', compact('rooms'));
    }

    /**
     * Show more rooms requested via ajax.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showMoreRooms()
    {
        if (! request()->ajax())
            abort(404);

        $rooms = $this->roomRepository->getAllActiveRooms(true);
        $elementsHtml = "";

        foreach($rooms as $room) {
            $elementsHtml .= view('components.card-room', compact('room'))->toHtml();
        }

        return response()->json([
            'hasMorePages' => $rooms->hasMorePages(),
            'page'         => $rooms,
            'elements'     => $elementsHtml
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = $this->roomRepository->findById($id, true);
        $user = auth()->user();
        
        $isJoined = $room->users->contains('id', $user->id);
        $users = $room->users->where('id', '<>', $user->id);

        if (! $isJoined) {
            if ($room->users->count() < $room->limit) {
                $room->users()->attach($user);
                broadcast(new UserJoinedARoom($room, $user))->toOthers();
            } else {
                return back()->withErrors(__('The room :name is full.', ['name' => $room->name]));
            }
        }

        return view('room.show', compact('room', 'users'));
    }
    
    public function sendMessage(Request $request, $id)
    {
        $user = auth()->user();

        $message = $this->roomRepository->createMessage($id, $user->id, $request->message);

        broadcast(new MessageWasSent($message))->toOthers();

        return response()->json([
            'message' => [
                'id'         => $message->id,
                'body'       => $message->body,
                'user'       => $message->user,
                'created_at' => __('Sent') . ' ' . $message->created_at->diffForHumans(),
            ]
        ], 200);
    }

    /**
     * Leave a room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leave($id)
    {
        $user = auth()->user();
        
        $this->roomRepository->removeUserFromARoom($user->id, $id);

        $room = $this->roomRepository->findById($id)->load('users');

        broadcast(new UserLeftARoom($user, $room))->toOthers();

        return redirect()->route('room.index');
    }
}

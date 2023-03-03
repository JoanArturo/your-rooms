<?php

namespace App\Http\Controllers;

use App\Interfaces\RoomRepositoryInterface;

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
        $rooms = $this->roomRepository->getAllSort('created_at', 'desc', true);

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

        $rooms = $this->roomRepository->getAllSort('created_at', 'desc', true);
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
        $room = $this->roomRepository->findById($id);
        $user = auth()->user();

        $isJoined = $room->users->contains('id', $user->id);

        if (! $isJoined) {
            if ($room->users->count() < $room->limit) {
                $room->users()->attach($user);
            } else {
                return back()->withErrors(__('The room :name is full.', ['name' => $room->name]));
            }
        }

        return view('room.show', compact('room'));
    }
}

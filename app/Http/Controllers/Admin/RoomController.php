<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RoomRepositoryInterface;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = $this->roomRepository->getAllSort('id', 'desc', true);

        return view('admin.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'        => 'required',
            'slug'        => 'required|unique:rooms',
            'description' => 'required',
            'limit'       => 'required|numeric|min:2',
            'active'      => 'nullable'
        ]);

        $this->roomRepository->create($fields);

        return redirect()->route('admin.room.index')->with('success', __('Room created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $room = $room->load('users');
        
        return view('admin.room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $fields = $request->validate([
            'name'        => 'required',
            'slug'        => 'required|unique:rooms,slug,' . $room->id,
            'description' => 'required',
            'limit'       => 'required|numeric|min:2',
            'active'      => 'nullable'
        ]);

        $this->roomRepository->update($room->id , $fields);

        return redirect()->route('admin.room.index')->with('success', __('The room data has been successfully updated.'));
    }

    /**
     * Show delete modal.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function delete(Room $room)
    {
        if (! request()->ajax())
            abort(404);

        return view('admin.room.partials._delete', compact('room'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $this->roomRepository->delete($room->id);

        return response()->json(null, 204);
    }
}

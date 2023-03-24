<?php

function allRooms()
{
    return \App\Room::with('users')->latest()->whereActive(1)->get();
}

function activeRoomsNumber()
{
    return \App\Room::with('users')->whereActive(1)->count();
}

function openRoomsOfTheCurrentUser()
{
    return \Auth::user()->rooms->load('users')->where('active', 1);
}

function numberOfOpenRoomsOfTheCurrentUser()
{
    return openRoomsOfTheCurrentUser()->count();
}
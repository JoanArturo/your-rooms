<?php

function allRooms()
{
    return \App\Room::latest()->whereActive(1)->get();
}

function activeRoomsNumber()
{
    return \App\Room::whereActive(1)->count();
}
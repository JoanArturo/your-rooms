<?php

namespace App\Listeners;

use App\Events\UserJoinedARoom;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserInformationToRoomUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserJoinedARoom  $event
     * @return void
     */
    public function handle(UserJoinedARoom $event)
    {
        //
    }
}

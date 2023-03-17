<?php

namespace App\Listeners;

use App\Events\UserLeftARoom;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InformUsers
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
     * @param  UserLeftARoom  $event
     * @return void
     */
    public function handle(UserLeftARoom $event)
    {
        //
    }
}

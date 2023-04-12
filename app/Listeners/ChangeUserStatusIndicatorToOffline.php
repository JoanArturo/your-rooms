<?php

namespace App\Listeners;

use App\Events\UserLoggedOut;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeUserStatusIndicatorToOffline
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
     * @param  UserLoggedOut  $event
     * @return void
     */
    public function handle(UserLoggedOut $event)
    {
        $user = $event->user;
        $user->is_active = false;
        $user->save();
    }
}

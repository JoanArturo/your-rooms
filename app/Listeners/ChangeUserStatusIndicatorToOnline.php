<?php

namespace App\Listeners;

use App\Events\UserIsLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeUserStatusIndicatorToOnline
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
     * @param  UserIsLoggedIn  $event
     * @return void
     */
    public function handle(UserIsLoggedIn $event)
    {
        $user = $event->user;
        $user->is_active = true;
        $user->save();
    }
}

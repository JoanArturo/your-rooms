<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\MessageWasSent::class => [
            \App\Listeners\SendMessageToUsers::class
        ],
        \App\Events\UserJoinedARoom::class => [
            \App\Listeners\SendUserInformationToRoomUsers::class
        ],
        \App\Events\UserLeftARoom::class => [
            \App\Listeners\InformUsers::class
        ],
        \App\Events\UserIsLoggedIn::class => [
            \App\Listeners\ChangeUserStatusIndicatorToOnline::class
        ],
        \App\Events\UserLoggedOut::class => [
            \App\Listeners\ChangeUserStatusIndicatorToOffline::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

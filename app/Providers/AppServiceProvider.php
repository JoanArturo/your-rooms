<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.modal', 'modal');
        Blade::component('components.card-room', 'cardroom');
        Blade::component('components.message', 'message');
        Blade::component('components.card-user', 'carduser');

        VerifyEmail::toMailUsing(function($notifiable, $url) {
            return (new MailMessage)
                ->subject(__('Verify Email Address'))
                ->line(__('Click the button below to verify your email address.'))
                ->action(__('Verify Email Address'), $url);
        });
    }
}

<?php

namespace App\Providers;

use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\SuggestionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\RoomRepository;
use App\Repositories\SuggestionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SuggestionRepositoryInterface::class, SuggestionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

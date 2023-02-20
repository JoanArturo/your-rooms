<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Suggestion;
use App\User;
use Faker\Generator as Faker;

$factory->define(Suggestion::class, function (Faker $faker) {
    return [
        'body'    => $faker->paragraph(),
        'user_id' => User::all()->random()
    ];
});

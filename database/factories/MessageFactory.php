<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\Room;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'body'    => $faker->paragraph(),
        'user_id' => User::all()->random(),
        'room_id' => Room::all()->random()
    ];
});

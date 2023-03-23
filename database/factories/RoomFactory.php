<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Room::class, function (Faker $faker) {
    $name = $faker->name();
    $slug = Str::slug($name);

    return [
        'name'        => $name,
        'slug'        => $slug,
        'description' => $faker->paragraph(),
        'limit'       => $faker->numberBetween(10, 500),
        'active'      => true,
    ];
});

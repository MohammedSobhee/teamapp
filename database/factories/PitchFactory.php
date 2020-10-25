<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pitch;
use Faker\Generator as Faker;

$factory->define(Pitch::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'owner_id' => 2,
        'city_id' => 3,
        'address' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'status' => 'active',
        'cost_hour' => $faker->numberBetween(10, 100),
    ];
});

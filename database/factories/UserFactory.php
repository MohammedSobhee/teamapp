<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'nick_name' => $faker->name,
        'city_id' => 3,
        'primer_position_id' => 1,
        'secondary_position_id' => 2,
        'height' => $faker->numberBetween(1, 200),
        'weight' => $faker->numberBetween(1, 200),
        'verification_code' => '1234',
        'is_confirm_code' => 1,
        'favorite_leg' => 'right',
        'type' => 'player',
        'is_active' => 1,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('123456'), // password
        'remember_token' => Str::random(10),
    ];
});

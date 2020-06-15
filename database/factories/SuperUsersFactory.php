<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SuperUsers;
use Faker\Generator as Faker;

$factory->define(SuperUsers::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'role_id' => 2
    ];
});
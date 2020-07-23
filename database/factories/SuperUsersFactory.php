<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SuperUsers;
use App\Role;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(SuperUsers::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'role_id' => Role::pluck('id')->random(1)[0],
        'profile_id' => Profile::pluck('id')->random(1)[0]
    ];
});
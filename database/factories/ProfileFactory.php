<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'gender' => (($faker->numberBetween($min = 1, $max = 2) == 1) ? 'male' : 'female'),
        'place_of_birth' => $faker->city,
        'date_of_birth' => $faker->iso8601($max = 'now'),
        'contact_number' => $faker->phoneNumber,
        'address' => $faker->address,
        'user_image' => 'a.jpg',
        'bio' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true)
    ];
});

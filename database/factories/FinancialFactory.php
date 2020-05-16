<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Financial;
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

$factory->define(Financial::class, function (Faker $faker) {
	return [
		'type' => $faker->word,
        'amount' => $faker->numberBetween($min = 1000, $max = 999999),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
	];
});
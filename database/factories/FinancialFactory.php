<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Financial;
use App\User;
use App\Category;
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
		'type' => (($faker->numberBetween($min = 1, $max = 2) == 1) ? 'wallet' : 'pay'),
        'amount' => $faker->numberBetween($min = 1, $max = 999999)*1000,
        'user_id' => User::pluck('id')->random(1)[0],
        'category_id' => Category::pluck('id')->random(1)[0],
        'created_at' => $faker->dateTimeBetween('-5 years', '+30 days'),
	];
});
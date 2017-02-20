<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Event::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->sentence(rand(2,7)),
        'desc_short' => $faker->text(rand(20,300)),
        'desc_long' => $faker->text(rand(200,1000)),
        'price' => $faker->numberBetween(5,20),
        'datetime' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = '+2 months'),
    ];
});

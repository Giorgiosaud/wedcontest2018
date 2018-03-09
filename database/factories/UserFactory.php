<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'last_name'      => $faker->lastName,
        'country'        => $faker->countryCode,
        'phone'          => $faker->phoneNumber,
        'referred'       => $faker->randomElement(['invited', 'contact', 'another']),
        'language'       => $faker->languageCode,
        'subscribed'     => true,
        'confirmed'      => true,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->state(App\User::class, 'unconfirmed', function () {
    return [
        'confirmed' => false,
    ];
});
$factory->state(App\User::class, 'unsubscribbed', function () {
    return [
        'subscribed' => false,
    ];
});
$factory->state(App\User::class, 'unconfirmedunsubscribbed', function () {
    return [
        'subscribed' => false,
        'confirmed'  => false,

    ];
});

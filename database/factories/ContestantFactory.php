<?php

use App\Contestant;
use Faker\Generator as Faker;

$factory->define(Contestant::class, function (Faker $faker) {
    return [
        'name'            => $faker->name,
        'last_name'       => $faker->lastName,
        'email'           => $faker->unique()->safeEmail,
        'dob'             => $faker->dateTimeBetween('-15 years'),
        'motivo'          => $faker->paragraphs(2, true),
        'representant_id' => function () {
            $user = factory(\App\User::class)->create();

            return $user->id;
        },
        //
    ];
});

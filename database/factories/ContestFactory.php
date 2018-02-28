<?php

use App\Contest;
use Faker\Generator as Faker;

$factory->define(\App\Contest::class, function (Faker $faker) {
    static $yearOfContest=2018;
    $title = $faker->sentence;
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'topic' => $title,
        'slug' => str_slug($title),
        'description'=>$faker->paragraph(50,true),
        'year' => $yearOfContest--

    ];
});

<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'contest_id' => function () {
            return factory(\App\Contest::class)->create()->id;
        },
        'name'    => $faker->sentences(1, true),
        'max_age' => $faker->unique()->numberBetween(0, 18),
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(\App\Contestant::class, function (Faker $faker) {
//    date de 0 a 18 anos
    $dob=$faker->date();

    $dob=\Carbon\Carbon::createFromFormat('Y-m-d',$dob);

    $age=$faker->numberBetween(0,18);

    $dob->year=\Carbon\Carbon::now()->year-$age;



    return [
        'name' => $faker->firstName,
        'representant_id'=>function(){
            return factory(\App\User::class)->create()->id;
        },
        'last_name' => $faker->lastName,
        'dob' => $dob->format('Y-m-d')
    ];
});

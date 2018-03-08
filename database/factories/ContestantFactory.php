<?php

use Faker\Generator as Faker;
use App\Role;

$factory->define(\App\Contestant::class, function (Faker $faker) {
//    date de 0 a 18 anos
    $dob=$faker->date();

    $dob=\Carbon\Carbon::createFromFormat('Y-m-d', $dob);

    $age=$faker->numberBetween(0, 18);

    $dob->year=\Carbon\Carbon::now()->year-$age;



    return [
        'name' => $faker->firstName,
        'representant_id'=>function () {
            $user= factory(\App\User::class)->create();
            $roles_id=Role::whereName('Representant')->pluck('id');
            $user->roles()->sync($roles_id);
            return $user->id;
        },
        'last_name' => $faker->lastName,
        'dob' => $dob->format('Y-m-d')
    ];
});
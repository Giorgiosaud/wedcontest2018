<?php

use App\Contest;
use Faker\Generator as Faker;
use App\Role;

$factory->define(\App\Contest::class, function (Faker $faker) {
    static $yearOfContest=2018;
    $title = $faker->sentence;
    return [
        'user_id' => function () {
            $user= factory(\App\User::class)->create();
            $roles_id=Role::whereName('Representant')->pluck('id');
            $user->roles()->sync($roles_id);
            return $user->id;
        },
        'active'=>false,
        'topic' => $title,
        'slug' => str_slug($title),
        'description'=>$faker->paragraph(50, true),
        'year' => $yearOfContest--

    ];
});
$factory->state(App\Contest::class, 'active', function () {
    return [
        'active' => true
    ];
});
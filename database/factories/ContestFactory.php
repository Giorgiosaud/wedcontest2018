<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(\App\Contest::class, function (Faker $faker) {
    static $yearOfContest = 2018;
    $title = $faker->sentence;

    return [
        'user_id' => function () {
            $user = factory(\App\User::class)->create();
            $roles_id = Role::whereName('Representant')->pluck('id');
            $user->roles()->sync($roles_id);

            return $user->id;
        },
        'active'     => false,
        'en'=>[
            'topic'      => $title,
            'description'=> $faker->paragraph(50, true),
        ],
        'es'=>[
            'topic'      => $title.'-es',
            'description'=> $faker->paragraph(50, true).'-es',
        ],
        
        'slug'       => str_slug($title),
        
        'year'       => $yearOfContest--,

    ];
});
$factory->state(App\Contest::class, 'active', function () {
    return [
        'active' => true,
    ];
});

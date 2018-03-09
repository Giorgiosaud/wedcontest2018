<?php

use App\Role;
use App\User;

function create($class, $attributes = [], $times = null, $type = 'Representant')
{
    if ($class === User::class) {
        $users = factory($class, $times)->create($attributes);
        $role = Role::whereName($type)->first();

        if ($users instanceof User) {
            $users->roles()->attach($role);

            return $users;
        }
        $users->each(function ($user) use ($role) {
            $user->roles()->attach($role);
        });

        return $users;
    }

    return factory($class, $times)->create($attributes);
}
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

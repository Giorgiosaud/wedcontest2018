<?php

use App\Role;
use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=factory(\App\User::class)->create(
            [
                'name' => 'Jorge Luis',
                'last_name' => 'Saud Rosal',
                'country' => 'CL',
                'phone' => '+56952218734',
                'referred' => 'invited',
                'language' => 'es',
                'subscribed' => true,
                'confirmed' => true,
                'email' => 'jorgelsaud@gmail.com',
                'password' => bcrypt('W3dc0nt3st'),
                'remember_token' => str_random(10),
            ]);
        $roles_id=Role::all()->pluck('id');
        $user->roles()->sync($roles_id);

    }
}

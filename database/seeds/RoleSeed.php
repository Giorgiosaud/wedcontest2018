<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create([
            'name'=> 'Administrator',
        ]);
        factory(Role::class)->create([
            'name'=> 'Representant',
        ]);
        factory(Role::class)->create([
            'name'=> 'Judge',
        ]);
        factory(Role::class)->create([
            'name'=> 'Contestant',
        ]);
    }
}

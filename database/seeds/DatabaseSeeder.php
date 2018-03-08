<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UsersSeed::class);
        $this->call(ContestAndCategoriesSeed::class);
        $this->call(ContestantsSeed::class);
    }
}

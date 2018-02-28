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
         $this->call(ContestAndCategoriesSeed::class);
        $this->call(ContestantsSeed::class);
        $this->call(CountriesSeed::class);
    }
}

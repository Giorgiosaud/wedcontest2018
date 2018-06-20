<?php

use Illuminate\Database\Seeder;

class ContestantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contestant = factory(\App\Contestant::class)->create(
            [
                'name'            => 'Santiago',
                'last_name'       => 'Saud',
                'email'           => 'jorgelsaudSantiago@gmail.com',
                'dob'             => '2015-10-19',
                'motivo'          => 'null',
                'slug'            => 'santiago_saud',
                'representant_id' => 1,
            ]
        );
        $contestant->categories()->attach(5, ['status'=>'approved']);
        $contestants = factory(\App\Contestant::class, 4)->create();
        $categoriesId = \App\Category::all()->pluck('id')->toArray();
        $faker = Faker\Factory::create();
        foreach ($contestants as $contestant) {
            $contestant->categories()->attach([$faker->randomElement($categoriesId)=> ['status'=>$faker->randomElement(['pending', 'approved'])]]);
        }
    }
}

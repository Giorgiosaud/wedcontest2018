<?php

use Illuminate\Database\Seeder;

class ContestAndCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cont = factory(App\Contest::class)->states('active')->create();
        $categories = [
            ['name' => 'Seeds', 'max_age' => 3, 'contest_id' => $cont->id],
            ['name' => 'Sprouts', 'max_age' => 7, 'contest_id' => $cont->id],
            ['name' => 'Thinkers', 'max_age' => 10, 'contest_id' => $cont->id],
            ['name' => 'Game Changers', 'max_age' => 15, 'contest_id' => $cont->id],
        ];
        foreach ($categories as $category) {
            \App\Category::create($category);
        }
        factory(App\Contest::class, 3)->create()->each(
            function ($contest) {
                $categories = [
                    ['name' => 'Seeds', 'max_age' => 3, 'contest_id' => $contest->id],
                    ['name' => 'Sprouts', 'max_age' => 7, 'contest_id' => $contest->id],
                    ['name' => 'Thinkers', 'max_age' => 10, 'contest_id' => $contest->id],
                    ['name' => 'Game Changers', 'max_age' => 15, 'contest_id' => $contest->id],
                ];
                foreach ($categories as $category) {
                    \App\Category::create($category);
                }

                return $categories;
            }
        );
    }
}

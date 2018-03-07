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
        $cont=factory(App\Contest::class)->states('active')->create();
        factory(\App\Category::class,3)->create(['contest_id'=>$cont->id]);
        factory(App\Contest::class, 3)->create()->each(
            function ($contest) {
                $categories=factory(App\Category::class, 3)->make(['contest_id' => $contest->id]);
                foreach ($categories as $category){
                    repeat:
                    try{
                        $category->save();
                    } catch (\Illuminate\Database\QueryException $e) {
                        $category = factory(App\Category::class)->make(['contest_id' => $contest->id]);
                        goto repeat;
                    }
                }
                return $categories;
            }
        );
    }
}

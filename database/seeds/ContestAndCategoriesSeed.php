<?php

use Illuminate\Database\Seeder;

class ContestAndCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $contests=[ [
            'user_id' => 1,
            'active'     => false,
            'en'         => [
                'topic'      => 'The Ocean is Your Home',
                'description'=> 'The Ocean is Your Home',
            ],
            'es'=> [
                'topic'      => 'El Oceano es tu Hogar',
                'description'=> 'El Oceano es tu Hogar',
            ],
            'slug'       => 'ocean-is-your-home',
            'year'       => 2017,

        ],
        [
            'user_id' => 1,
            'active'     => true,
            'en'         => [
                'topic'      => 'Rethinking Plastic',
                'description'=> '<div>Welcome to our World Environment Day Drawing Contest 2018</div>',
                'logo_image'=>'contest/rethinking-plastic/esLogo.jpg'

            ],
            'es'=> [
                'topic'      => 'Reinventando el Plástico',
                'description'=> '<div>Concurso de Dibujo 2018 del Día mundial del Medio Ambiente</div>',
                'logo_image'=>'contest/rethinking-plastic/enLogo.jpg'
            ],
            'slug'       => 'rethinking-plastic',
            'year'       => 2018,
            'background_image'=>'contest/rethinking-plastic/backgroundImage.jpg'

        ]
    ];
        foreach($contests as $contest){
            $cont=factory(App\Contest::class)->create($contest);
            $categories = [
                ['name' => 'Seeds', 'max_age' => 3, 'color'=>'bg-seeds-'.$cont->slug, 'contest_id' => $cont->id],
                ['name' => 'Sprouts', 'max_age' => 7, 'color'=>'bg-sprouts-'.$cont->slug, 'contest_id' => $cont->id],
                ['name' => 'Thinkers', 'max_age' => 10, 'color'=>'bg-thinkers-'.$cont->slug, 'contest_id' => $cont->id],
                ['name' => 'Game Changers', 'max_age' => 15, 'color'=>'bg-game-changers-'.$cont->slug, 'contest_id' => $cont->id],
            ];
            foreach ($categories as $category) {
                \App\Category::create($category);
            }
        };
    }
}

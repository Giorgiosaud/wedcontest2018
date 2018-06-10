<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateContestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_administrator_user_can_create_new_contest()
    {
        $this->withExceptionHandling();
        $role = Role::whereName('Administrator')->first();
        $user = factory(User::class)->create();
        $user->roles()->attach($role->id);
        $this->signIn($user);
        $contest = ['user_id' => 1,
            'active'          => true,
            'en'              => [
                'topic'      => 'Rethinkiddng Plastic',
                'description'=> '<div>Welcome to our World Environment Day Drawing Contest 2018</div>',
                'logo_image' => 'contest/rethinking-plastic/enLogo.jpg',

            ],
            'es'=> [
                'topic'      => 'Reinventando eld Plástico',
                'description'=> '<div>Concurso de Dibujo 2018 del Día mundial del Medio Ambiente</div>',
                'logo_image' => 'contest/rethinking-plastic/esLogo.jpg',
            ],
            'slug'            => 'rethinkinddg-plastic',
            'year'            => 2018,
            'background_image'=> 'contest/rethinking-plastic/backgroundImage.jpg',
        ];
        // dd($this->get($response->headers->get('Location')));
        $response = $this->post(route('contest.store'), $contest)
        ->assertRedirect();
        // ->assertSee($contest['en']['topic'])
        // ->assertSee($contest['en']['description'])
        // ->assertSee((string) $contest['year']);

        // $this->get($response->headers->get('Location'));
    }

    /**
     * @test
     */
    public function guest_may_not_create_a_contest()
    {
        $this->withExceptionHandling();
        $this->get(route('contest.create'))
        ->assertRedirect('/login');
        // $this->post('/contest')
        // ->assertRedirect('/login');
    }
}

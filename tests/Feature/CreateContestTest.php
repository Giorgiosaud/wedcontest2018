<?php

namespace Tests\Feature;

use App\Contest;
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
    	$contest=[
    		'en'=>[
    			'topic'=>'Ocean',
    			'description'=>'Ocean Description'
    		],
    		'es'=>[
    			'topic'=>'Oceano',
    			'description'=>'Descripcion Oceano'	
    		],
    		'year'=>'2000',
            'normalCategories'=>true
    	];
    	$response = $this->post('/contests', $contest);
    	$this->get($response->headers->get('Location'))
    	->assertSee($contest['en']['topic'])
    	->assertSee($contest['en']['description'])
    	->assertSee((string) $contest['year']);


        // $this->get($response->headers->get('Location'))

    }

    /**
     * @test
     */
    public function guest_may_not_create_a_contest()
    {
    	$this->withExceptionHandling();
    	$this->get('/contests/create')
    	->assertRedirect('/login');
    	$this->post('/contests')
    	->assertRedirect('/login');
    }
}

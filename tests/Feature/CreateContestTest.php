<?php

namespace Tests\Feature;

use App\Contest;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateContestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    function an_administrator_user_can_create_new_contest()
    {
        $user=factory(User::class)->create(['email'=>'jorgelsaud@gmail.com']);
        $this->signIn($user);
        $contest= make(Contest::class);
        $response = $this->post('/contests', $contest->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($contest->topic)
            ->assertSee((string)$contest->year)
            ->assertSee($contest->description);
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

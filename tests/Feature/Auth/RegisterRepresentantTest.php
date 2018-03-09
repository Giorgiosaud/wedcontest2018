<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Newsletter\NewsletterFacade;

/**
* Class CreateRepresentantTest
* @package Tests\Feature
*/
class RegisterRepresentantTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $userInitialCount;
    
    /**
    *
    */
    public function setUp()
    {
        parent::setUp();
        
        
        Mail::fake();
        $this->userInitialCount=User::all()->count();
    }
    /**
    * @param array $overrides
    * @return array
    */
    private function validParams($overrides = [])
    {
        return array_merge([
            'name' => 'Pedro',
            'last_name' => 'Perez',
            'country' => 'CL',
            'phone' => '+56528899982',
            'referred' => 'invited',
            'language' => 'Es',
            'subscribed' => true,
            'email' => 'ppres@zon.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ], $overrides);
    }
    
    /**
    * @test
    */
    public function a_guest_can_register_as_representant_and_appears_as_unconfirmed()
    {
        NewsletterFacade::shouldReceive('subscribe')->once()->with('ppres@zon.com')->andReturn(true);
        
        $userCount=User::all()->count();
        
        $this->withExceptionHandling();
        $response = $this->post(route('register'), $this->validParams());
        
        
        $response->assertRedirect('/the_contest');
        $this->assertTrue(Auth::check());
        $userCount++;
        $this->assertCount($userCount, User::all());
        
        tap(auth()->user(), function ($user) {
            $this->assertEquals('Pedro', $user->name);
            $this->assertEquals('Perez', $user->last_name);
            $this->assertEquals('CL', $user->country);
            $this->assertEquals('+56528899982', $user->phone);
            $this->assertEquals('invited', $user->referred);
            $this->assertEquals(true, $user->subscribed);
            $this->assertEquals(false, $user->confirmed);
            $this->assertEquals('ppres@zon.com', $user->email);
            $this->assertTrue(Hash::check('secret', $user->password));
            $this->assertEquals(25, strlen($user->confirmation_token));
        });
    }
    /** @test */
    public function user_can_fully_confirm_their_email_addresses()
    {
        NewsletterFacade::shouldReceive('subscribe')->once()->with('ppres@zon.com')->andReturn(true);
        
        $userCount=User::all()->count();
        
        $this->withExceptionHandling();
        $response = $this->post(route('register'), $this->validParams(['confirmed'=>false]));
        $response->assertRedirect('/the_contest');
        $this->assertTrue(Auth::check());
        $user=User::whereEmail('ppres@zon.com')->first();
        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);
        $this->get(route('register.confirm', ['token' => $user->confirmation_token]))
        ->assertRedirect(route('the_contest'));
        
        
        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->confirmed);
            $this->assertNull($user->confirmation_token);
        });
    }
    
    /** @test */
    public function confirming_an_invalid_token()
    {
        $this->get(route('register.confirm', ['token' => 'invalid']))
        ->assertRedirect(route('the_contest'))
        ->assertSessionHas('flash', 'Unknown token.');
    }
    
    /** @test */
    public function name_cannot_exceed_255_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
            'name' => str_repeat('a', 256),
            ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('name');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
        
    /** @test */
    public function email_is_required()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                'email' => '',
                ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
            
    /** @test */
    public function email_is_valid()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                    'email' => 'not-an-email-address',
                    ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
    /** @test */
    public function email_cannot_exceed_255_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                        'email' => substr(str_repeat('a', 256) . '@example.com', -256),
                        ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
    /** @test */
    public function email_is_unique()
    {
        create(\App\User::class, ['email' => 'johndoe@example.com']);
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                            'email' => 'johndoe@example.com',
                            ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $userCount=$this->userInitialCount+1;
        $this->assertCount($userCount, User::all());
    }
    /** @test */
    public function password_is_required()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                                'password' => '',
                                ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
    /** @test */
    public function password_must_be_confirmed()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                                    'password' => 'foo',
                                    'password_confirmation' => 'bar'
                                    ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
    /** @test */
    public function password_must_be_6_chars()
    {
        $this->withExceptionHandling();
        $this->from(route('register'));
        $response = $this->post(route('register'), $this->validParams([
                                        'password' => 'foo',
                                        'password_confirmation' => 'foo',
                                        ]));
        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('password');
        $this->assertFalse(Auth::check());
        $this->assertCount($this->userInitialCount, User::all());
    }
}

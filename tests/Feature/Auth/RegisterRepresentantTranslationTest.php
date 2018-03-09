<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Class CreateRepresentantTest.
 */
class RegisterRepresentantTranslationTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        Mail::fake();
        // (new \DatabaseSeeder)->run();
    }

    /**
     * @param array $overrides
     *
     * @return array
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'name'                  => 'Pedro',
            'last_name'             => 'Perez',
            'country'               => 'VE',
            'phone'                 => '+56528899982',
            'referred'              => 'invited',
            'language'              => 'es',
            'subscribed'            => true,
            'email'                 => 'ppres@zon.com',
            'password'              => 'secret',
            'password_confirmation' => 'secret',
        ], $overrides);
    }

    /**
     * @test
     */
    public function a_user_see_form_in_english_if_browser_locale_is_set_in_english()
    {
        $this->withExceptionHandling();
        App::setLocale('en');
        $this->get(route('register'))
            ->assertSee('Name')
            ->assertSee('Last Name')
            ->assertSee('Phone')
            ->assertSee('E-Mail Address')
            ->assertSee('Country')
            ->assertSee('Brazil')
            ->assertSee('Antigua and Barbuda');
        App::setLocale('es');
        $this->get(route('register'))
            ->assertSee('Nombre')
            ->assertSee('Apellido')
            ->assertSee('Telefono')
            ->assertSee('Email')
            ->assertSee('País')
            ->assertSee('Brasil')
            ->assertSee('Antigua y Barbuda');
    }

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration_in_spanish()
    {
        $this->post(route('register'), $this->validParams(['language'=>'es']));
        Mail::assertQueued(PorFavorConfirmeSuCorreo::class);
    }

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration_in_english()
    {
        App::setLocale('en');
        $this->post(route('register'), $this->validParams(['language'=>'en']));
        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }

    /**
     * @test
     */
    public function a_user_see_form_in_english_if_browser_locale_is_set_in_spanish()
    {
        App::setLocale('es');
        $this->get(route('register'))
            ->assertSee('Nombre');
    }
}

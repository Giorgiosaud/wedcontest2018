<?php

namespace Tests\Feature;

use App\CountryTranslation;
use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webpatser\Countries\Countries;

/**
 * Class CreateRepresentantTest
 * @package Tests\Feature
 */
class RegisterRepresentantTranslationTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        Mail::fake();
//        DB::table(config('countries.table_name'))->delete();
        (new \CountriesSeed)->run();
        //Get all of the countries
//        $countries = (new \Webpatser\Countries\Countries)->getList();
//        foreach ($countries as $countryId => $country){
//            DB::table(config('countries.table_name'))->insert(array(
//                'id' => $countryId,
//                'capital' => ((isset($country['capital'])) ? $country['capital'] : null),
//                'citizenship' => ((isset($country['citizenship'])) ? $country['citizenship'] : null),
//                'country_code' => $country['country-code'],
//                'currency' => ((isset($country['currency'])) ? $country['currency'] : null),
//                'currency_code' => ((isset($country['currency_code'])) ? $country['currency_code'] : null),
//                'currency_sub_unit' => ((isset($country['currency_sub_unit'])) ? $country['currency_sub_unit'] : null),
//                'currency_decimals' => ((isset($country['currency_decimals'])) ? $country['currency_decimals'] : null),
//                'full_name' => ((isset($country['full_name'])) ? $country['full_name'] : null),
//                'iso_3166_2' => $country['iso_3166_2'],
//                'iso_3166_3' => $country['iso_3166_3'],
//                'name' => $country['name'],
//                'region_code' => $country['region-code'],
//                'sub_region_code' => $country['sub-region-code'],
//                'eea' => (bool)$country['eea'],
//                'calling_code' => $country['calling_code'],
//                'currency_symbol' => ((isset($country['currency_symbol'])) ? $country['currency_symbol'] : null),
//                'flag' =>((isset($country['flag'])) ? $country['flag'] : null),
//            ));
//            $data = [
//                'code' => 'Br',
//                'en'  => ['name' => 'Greece'],
//                'fr'  => ['name' => 'Grèce'],
//            ];
//        }
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
            'country' => 'VE',
            'phone' => '+56528899982',
            'referred' => 'invited',
            'language' => 'es',
            'subscribed' => true,
            'email' => 'ppres@zon.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ], $overrides);
    }

    /**
     * @test
     */
    public function a_user_see_form_in_english_if_browser_locale_is_set_in_english()
    {
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

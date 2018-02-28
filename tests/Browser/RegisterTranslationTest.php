<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTranslationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/en/register')
            ->assertSee('Name')
                ->assertSee('Last Name')
                ->assertSee('Phone')
                ->assertSee('E-Mail Address')
                ->assertSee('Country')
                ->assertSelectHasOptions('country',['Brazil','Antigua And Barbuda'])
            ->;
        });
    }
}

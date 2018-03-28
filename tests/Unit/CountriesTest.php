<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ContestantTest.
 */
class CountriesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var
     */
    protected $contestant;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function a_user_can_fetch_all_counties_via_api()
    {
        $this->withExceptionHandling();
        $this->getJson('api/countries')
        ->assertJsonCount(249);
    }
}

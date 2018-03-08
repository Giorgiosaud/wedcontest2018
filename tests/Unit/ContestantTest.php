<?php

namespace Tests\Unit;

use App\Contestant;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ContestantTest
 * @package Tests\Unit
 */
class ContestantTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @var
     */
    protected $contestant;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->contestant = create(Contestant::class);
    }

    /**
     * @test
     */
    public function a_contestant_must_have_a_representant()
    {
        $this->assertInstanceOf(User::class, $this->contestant->representant);
    }
}
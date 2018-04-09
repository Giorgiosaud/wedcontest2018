<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ContestantTest.
 */
class ImageTest extends TestCase
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
    public function assertTrueTest(){
    $this->assertTrue(true);
    }
}

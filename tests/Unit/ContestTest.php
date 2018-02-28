<?php

namespace Tests\Unit;

use App\Contest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ContestTest
 * @package Tests\Unit
 */
class ContestTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var
     */
    protected $contest;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->contest = create(Contest::class);
    }
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_contest_have_a_path()
    {
        $this->assertEquals(
            "/contests/{$this->contest->slug}",
            $this->contest->path()
        );
    }

    /**
     * @test
     */
    public function a_contest_can_be_called_by_slug(){
        $this->get('contests/'.$this->contest->slug)
            ->assertSee($this->contest->topic)
            ->assertSee($this->contest->description)
            ->assertSee((string)$this->contest->year);
    }
    /** @test */
    function a_contest_has_a_creator()
    {
        $this->assertInstanceOf(\App\User::class, $this->contest->creator);
    }
    /** @test */
    function a_thread_has_categories()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->contest->categories
        );
    }
}

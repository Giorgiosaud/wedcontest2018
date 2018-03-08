<?php

namespace Tests\Unit;

use App\Contest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
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
        $this->contest = create(\App\Contest::class);
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
    public function a_contest_can_be_called_by_slug()
    {
        $this->get('contests/'.$this->contest->slug)
            ->assertSee($this->contest->topic)
            ->assertSee($this->contest->description)
            ->assertSee((string)$this->contest->year);
    }
    /** @test */
    public function a_contest_has_a_creator()
    {
        $this->assertInstanceOf(\App\User::class, $this->contest->creator);
    }
    /** @test */
    public function a_thread_has_categories()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->contest->categories
        );
    }

    /**
     * @test
     */
    public function a_contest_have_active_prop()
    {
        $this->get('contests/'.$this->contest->slug)
            ->assertSee('Inactive');
    }
    /**
    * @test
     */
    public function a_contest_could_have_a_intro_image()
    {
        $data=[
            'intro_image'=>'http://concurso.zonapro/images/Home/ContestIntro.jpg'
        ];
        $this->getJson('contests/'.$this->contest->slug)
        ->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function a_default_contest_image_can_change()
    {
        $this->markTestSkipped("Working.");
    }
}

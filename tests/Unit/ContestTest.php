<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ContestTest.
 */
class ContestTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var
     */
    protected $contest;

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
            "/contest/{$this->contest->slug}",
            $this->contest->path()
        );
    }

    /**
     * @test
     */
    public function a_contest_can_be_called_by_slug_from_administrator()
    {
        $this->asAdmin();
        $this->get('contest/'.$this->contest->slug)
            ->assertSee($this->contest->topic)
            ->assertSee($this->contest->description)
            ->assertSee((string) $this->contest->year);
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
    public function a_contest_have_active_prop_and_can_be_viewed_as_admin()
    {
        $this->asAdmin();
        $this->get('contest/'.$this->contest->slug)
            ->assertSee('Inactive');
    }

    /**
     * @test
     */
    public function a_contest_could_have_a_intro_image()
    {
        $this->asAdmin();
        $data = [
            'background_image' => asset('/images/Home/ContestIntro.jpg'),
        ];
        $this->getJson('contest/'.$this->contest->slug)
            ->assertJsonStructure()
            ->assertJsonFragment($data);
    }

    public function a_default_contest_image_can_change()
    {
        $this->markTestSkipped('Working.');
    }
}

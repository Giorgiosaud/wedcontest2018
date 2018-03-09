<?php

namespace Tests\Feature;

use App\Category;
use App\Contest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ContestTest.
 */
class ReadContestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_see_all_tests()
    {
        $contest = factory(Contest::class)->create();
        $this->get('/contests')
            ->assertSee($contest->topic)
            ->assertSee((string) $contest->year);
    }

    /**
     * @test
     */
    public function a_can_see_a_single_test()
    {
        $contest = factory(Contest::class)->create();
        $this->get('/contests/'.$contest->slug)
            ->assertSee($contest->topic)
            ->assertSee($contest->description)
            ->assertSee((string) $contest->year);
    }

    /** @test */
    public function a_user_can_request_all_categories_for_a_given_contest()
    {
        $contest = create(Contest::class);
        create(Category::class, ['contest_id' => $contest->id], 2);
        $response = $this->getJson($contest->path().'/categories')->json();
        $this->assertCount(2, $response);
    }
}

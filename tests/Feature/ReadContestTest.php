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
    public function a_normal_user_can_not_see_all_contests()
    {
        $contest = factory(Contest::class)->create();
        $this->get(route('contests.index'))->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function a_normal_user_can_not_see_a_single_contest()
    {
        $contest = factory(Contest::class)->create();
        $this->get(route('contest.show',$contest->slug))
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_admin_user_can_request_all_categories_for_a_given_contest()
    {
        $this->withExceptionHandling();
        $this->asAdmin();
        $contest = create(Contest::class);
        create(Category::class, ['contest_id' => $contest->id], 2);
        $this->json('GET', $contest->path().'/categories')
            ->assertStatus(200);
    }

    /** @test */
    public function a_normal_user_can_not_request_all_categories_for_a_given_contest()
    {
        $this->withExceptionHandling();
        $contest = create(Contest::class);
        create(Category::class, ['contest_id' => $contest->id], 2);
        $this->json('GET', $contest->path().'/categories')
            ->assertStatus(403);
    }
}

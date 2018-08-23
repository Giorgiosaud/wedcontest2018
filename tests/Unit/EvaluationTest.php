<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EvaluationTest extends TestCase
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
        $categories = [
                ['name' => 'Seeds', 'max_age' => 3, 'color'=>'bg-seeds-'.$this->contest->slug, 'contest_id' => $this->contest->id],
                ['name' => 'Sprouts', 'max_age' => 7, 'color'=>'bg-sprouts-'.$this->contest->slug, 'contest_id' => $this->contest->id],
                ['name' => 'Thinkers', 'max_age' => 10, 'color'=>'bg-thinkers-'.$this->contest->slug, 'contest_id' => $this->contest->id],
                ['name' => 'Game Changers', 'max_age' => 15, 'color'=>'bg-game-changers-'.$this->contest->slug, 'contest_id' => $this->contest->id],
            ];

        foreach ($categories as $category) {
            \App\Category::create($category);
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function an_evaluation_page_is_shown_with_contest_categories_buttons()
    {
        $this->asJudge();
        $categories = $this->contest->categories->pluck('name');
        $this->get(route('evaluation.show', $this->contest->slug))
            ->assertSeeMany($categories);
    }
}

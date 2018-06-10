<?php

namespace Tests\Feature;

use App\Contest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EditContestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function only_an_administrator_can_edit_contest()
    {
        $contest = create(Contest::class);
        $this->withExceptionHandling();
        $this->get(route('contest.edit',$contest->slug))
            ->assertRedirect('/login');
    }
}

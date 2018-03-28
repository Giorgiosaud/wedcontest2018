<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Contest;

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
        $this->get("contests/$contest->slug/edit")
            ->assertRedirect('/login');
    }
}

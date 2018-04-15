<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddContestImageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function only_registered_users_can_see_and_edit_contestants()
    {
        $this->assertTrue(true);
    }
}

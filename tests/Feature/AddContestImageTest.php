<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddContestImageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function only_members_can_add_images_to_contest()
    {
        $this->withExceptionHandling();
        $this->json('POST', '/images/upload')
            ->assertStatus(403);
    }
}

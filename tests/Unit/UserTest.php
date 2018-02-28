<?php

namespace Tests\Unit;

use App\Contestant;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UserTest
 * @package Tests\Unit
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var
     */
    protected $user;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = create(User::class);
    }

    /**
     * @test
     */
    public function a_user_may_have_contestants()
    {
        factory(Contestant::class, 4)->create(['representant_id' => $this->user->id]);
        $this->assertInstanceOf(Collection::class, $this->user->contestants);
    }

    /**
     * @test
     */
    public function a_user_can_be_an_administrator(){
        $this->withExceptionHandling();
        $user=factory(User::class)->create(['email'=>'jorgelsaud@gmail.com']);
        $this->assertTrue($user->isAdmin());

    }
}

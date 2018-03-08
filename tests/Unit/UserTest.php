<?php

namespace Tests\Unit;

use App\Contestant;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        (new \DatabaseSeeder)->run();

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
    public function a_user_can_be_an_administrator()
    {
        $this->withExceptionHandling();
        
        $user=User::whereEmail('jorgelsaud@gmail.com')->first();
        $this->assertTrue($user->isAdmin());
    }

    /**
     * @test
     */
    public function all_users_have_at_least_one_role()
    {
        $this->assertInstanceOf(\App\Role::class, $this->user->roles->first());
    }
}

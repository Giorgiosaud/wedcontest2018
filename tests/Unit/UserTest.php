<?php

namespace Tests\Unit;

use App\Contestant;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class UserTest.
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var
     */
    protected $user;

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
    public function a_user_can_be_assigned_a_role()
    {
        $this->withExceptionHandling();
        $user = create(User::class);
        $user->setRole('Administrator');
        $this->assertTrue($user->isAdmin());
    }

    /**
     * @test
     */
    public function error_is_throw_if_roles_dont_exist()
    {
        $this->expectException(\Exception::class);
        $user = create(User::class);
        $user->setRole('Administrator23');
    }

    /**
     * @test
     */
    public function a_user_can_be_setted_as_administrator_by_another_administrator()
    {
        $this->withExceptionHandling();
        $user = create(User::class);
        $user->setRole('Administrator');
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

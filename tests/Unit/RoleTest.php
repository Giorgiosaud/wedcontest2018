<?php

namespace Tests\Unit;

use App\Contestant;
use App\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class UserTest.
 */
class RoleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function the_role_administrator_exist()
    {
        $this->assertCount(1, Role::whereName('Administrator')->get());
    }

    /**
     * @test
     */
    public function the_role_representant_exist()
    {
        $this->assertCount(1, Role::whereName('Representant')->get());
    }

    /**
     * @test
     */
    public function the_role_judge_exist()
    {
        $this->assertCount(1, Role::whereName('Judge')->get());
    }

    /**
     * @test
     */
    public function the_role_contestant_exist()
    {
        $this->assertCount(1, Role::whereName('Contestant')->get());
    }
}

<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        $this->seedMigrations();

        $this->disableExceptionHandling();
    }

    protected function seedMigrations()
    {
        (new \DatabaseSeeder())->run();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        $this->actingAs($user);

        return $this;
    }

    protected function asAdmin($admin = null)
    {
        $admin = $admin ?: User::whereEmail('jorgelsaud@gmail.com')->first();
        $this->actingAs($admin);

        return $this;
    }
    protected function asJudge($judge = null)
    {
        $judge = $judge ?: User::whereEmail('jorgelsaud@gmail.com')->first();
        $this->actingAs($judge);

        return $this;
    }

    // Hat tip, @adamwathan.
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class() extends Handler {
            public function __construct()
            {
            }

            public function report(\Exception $e)
            {
            }

            public function render($request, \Exception $e)
            {
                throw $e;
            }
        }
        );
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}

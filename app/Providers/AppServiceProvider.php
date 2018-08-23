<?php

namespace App\Providers;

use App\Country;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TestResponse::macro('assertSeeMany', function ($array) {
            foreach ($array as $text) {
                $this->assertSee($text);
            }

            return $this;
        });
        // Blade::component('components.header', 'header');
    // View::share('countries', Country::all());
    //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}

<?php

namespace App\Providers;

use App\Contest;
use App\Country;
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
        if (! $this->app->runningInConsole()) {

            $contest=Contest::whereActive(true)->first();
            View::share('contest', $contest);
        }
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

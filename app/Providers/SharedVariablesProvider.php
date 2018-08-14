<?php

namespace App\Providers;

use App\Contest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SharedVariablesProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $contest = Contest::whereActive(true)->first();
            View::share('contest', $contest);
            return $view->with('contest', $contest);
        });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

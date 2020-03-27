<?php

namespace Hallindavid\Manny;

use Illuminate\Support\ServiceProvider;

class MannyServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('manny', function() {
            return $this->app->make('Hallindavid\Manny\Manny');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}

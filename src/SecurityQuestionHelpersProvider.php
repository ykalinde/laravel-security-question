<?php

namespace Bluecloud\SecurityQuestionHelpers;

use Illuminate\Support\ServiceProvider;

class SecurityQuestionHelpersProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
    }

}
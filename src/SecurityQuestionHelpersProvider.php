<?php

namespace Bluecloud\SecurityQuestionHelpers;

use Illuminate\Support\Facades\Route;
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
        $this->mergeConfigFrom(__DIR__ . '/../config/questions.php', 'questions');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/questions.php' => config_path('questions.php'),
        ], 'questions');

        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->registerCommands();
        $this->registerRoutes();
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\MigrateQuestions::class,
            ]);
        }
    }

    protected function registerRoutes()
    {
        $prefix = config('questions.path', 'security-questions');
        $middleware = config('questions.middleware', []);

        Route::group(['prefix' => $prefix, "middleware" => $middleware], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });

    }


}
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
        $this->mergeConfigFrom(__DIR__.'/../config/questions.php', 'questions');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/questions.php' => config_path('questions.php'),
        ], 'questions');

        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
                Console\ClientCommand::class,
                Console\HashCommand::class,
                Console\KeysCommand::class,
                Console\PurgeCommand::class,
            ]);
        }
    }

}
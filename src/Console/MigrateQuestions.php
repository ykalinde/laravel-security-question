<?php

namespace Bluecloud\SecurityQuestionHelpers\Console;

use Bluecloud\SecurityQuestionHelpers\SecurityQuestion;
use Illuminate\Console\Command;

class MigrateQuestions extends Command
{

    protected $signature = 'questions:migrate';

    protected $description = 'Run the command to migrate default questions';

    public function handle()
    {
        $questions = config("questions.seeds");

        collect($questions)->each(function ($question) {
            if (SecurityQuestion::findByName($question) == null) {
                SecurityQuestion::query()->create(["name" => $question]);
            }
        });
    }

}
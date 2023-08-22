<?php

namespace Bluecloud\SecurityQuestionHelpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSecurityQuestions
{
    public function saveQuestions(array $questions)
    {
        /** @var Model $user */
        $user = $this;

        foreach ($questions as $question) {
            $answer = hash_answer($question["answer"]);
            $found = SecurityQuestionEntry::query()
                ->where("user_id", $user->getKey())
                ->where("security_question_id", $question["security_question_id"])
                ->first();
            if ($found) {
                $found->update(["answer" => $answer]);
            } else {
                SecurityQuestionEntry::query()->create([
                    "security_question_id" => $question["security_question_id"],
                    "answer" => $answer,
                    "user_id" => $user->getKey(),
                ]);
            }
        }
    }

    public function questions(): HasMany
    {
        /** @var Model $model */
        $model = $this;
        return $model->hasMany(SecurityQuestionEntry::class)->with("question");
    }
}

<?php

namespace Bluecloud\SecurityQuestionHelpers;

use Illuminate\Database\Eloquent\Model;

class SecurityQuestion extends Model
{
    protected $table = "security_questions";

    protected $guarded = [];

    public static function findByName($question)
    {
        return self::query()->where("name", $question)->first();
    }
}
<?php

namespace Bluecloud\SecurityQuestionHelpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityQuestionEntry extends Model
{
    protected $table = "security_question_entries";

    protected $guarded = [];

    protected $with = ["question"];

    public function question(): BelongsTo
    {
        return $this->belongsTo(SecurityQuestion::class, "security_question_id");
    }
}

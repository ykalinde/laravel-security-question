<?php

namespace Bluecloud\SecurityQuestionHelpers\Http\Controller;

use Bluecloud\SecurityQuestionHelpers\SecurityQuestion;
use Illuminate\Http\Request;

class SecurityQuestionsController
{
    public function index()
    {
        $questions = SecurityQuestion::query()->get();
        return response(["questions" => $questions]);
    }

    public function store(Request $request)
    {
        $question = SecurityQuestion::query()->create(["name" => $request->get("name")]);
        return response([
            "message" => "Created successfully",
            "question" => $question,
        ]);
    }

    public function destroy($id)
    {
        $question = SecurityQuestion::query()->find($id);
        $question->delete();
        return response(["message" => "removed successfully"]);
    }
}
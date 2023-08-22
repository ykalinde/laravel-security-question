<?php

use Bluecloud\SecurityQuestionHelpers\Http\Controller\SecurityQuestionsController;
use Illuminate\Support\Facades\Route;

Route::get("/", [SecurityQuestionsController::class, "index"]);
Route::post("/", [SecurityQuestionsController::class, "store"]);
Route::delete("/{question}", [SecurityQuestionsController::class, "destroy"]);

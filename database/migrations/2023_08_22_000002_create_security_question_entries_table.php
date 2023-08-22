<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('security_question_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId("security_question_id")->constrained("security_questions");
            $table->string("answer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_questions');
    }
};
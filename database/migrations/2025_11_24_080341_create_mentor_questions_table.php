<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mentor_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // question asked by
            $table->string('title');
            $table->longText('question');
            $table->enum('status', ['pending','answered','archived'])->default('pending');
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('mentor_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_question_id')->constrained('mentor_questions')->cascadeOnDelete();
            $table->foreignId('mentor_id')->nullable()->constrained('users')->nullOnDelete(); // mentor
            $table->longText('answer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_answers');
        Schema::dropIfExists('mentor_questions');
    }
};

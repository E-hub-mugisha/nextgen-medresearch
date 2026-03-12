<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mentee_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // From your registration form fields
            $table->text('bio')->nullable();
            $table->string('research_goal')->nullable();
            $table->string('education_level')->nullable();

            // Extra useful fields
            $table->string('institution')->nullable();       // university/school
            $table->string('country')->nullable();
            $table->string('availability')->nullable();      // part-time / full-time
            $table->string('profile_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentee_profiles');
    }
};

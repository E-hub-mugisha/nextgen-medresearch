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
        Schema::create('mentor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // From your mentor registration form fields
            $table->text('bio')->nullable();
            $table->string('expertise')->nullable();
            $table->string('organization')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('experience_years')->default(0);
            $table->unsignedInteger('max_mentees')->default(1);
            $table->boolean('available')->default(true);

            // Extra useful fields
            $table->string('academic_title')->nullable();    // Prof, Dr, etc.
            $table->string('linkedin_url')->nullable();
            $table->string('google_scholar_url')->nullable();
            $table->string('profile_photo')->nullable();
            $table->unsignedInteger('mentee_count')->default(0); // track current mentees
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_profiles');
    }
};

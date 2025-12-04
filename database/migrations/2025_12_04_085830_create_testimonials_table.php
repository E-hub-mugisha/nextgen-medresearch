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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Person giving testimonial
            $table->string('role')->nullable(); // Optional title/position
            $table->string('organization')->nullable(); // Hospital, institution, NGO, etc.
            $table->text('testimonial'); // Testimonial message
            $table->string('photo')->nullable(); // photo of person
            $table->integer('rating')->nullable(); // 1–5 stars (optional)
            $table->boolean('featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

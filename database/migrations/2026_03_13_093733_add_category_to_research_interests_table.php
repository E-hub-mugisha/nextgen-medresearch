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
        Schema::table('research_interests', function (Blueprint $table) {
            $table->string('category')->nullable(); // e.g. "Science", "Technology"
            $table->text('description')->nullable();
            $table->unsignedInteger('followers_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('research_interests', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('rescue_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('file_path'); // PDF or image
            $table->string('language')->nullable(); // EN, Kinyarwanda, etc.
            $table->string('qr_code_path')->nullable(); // stored QR image
            $table->integer('download_count')->default(0);
            $table->integer('scan_count')->default(0);
            $table->enum('status', ['draft','published'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rescue_sheets');
    }
};

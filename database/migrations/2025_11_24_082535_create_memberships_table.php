<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('type', [
                'individual', 
                'trainer', 
                'institutional', 
                'corporate', 
                'honorary'
            ])->default('individual');
            $table->text('organization')->nullable();
            $table->text('motivation')->nullable(); // why they want to join
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};

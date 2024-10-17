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
        Schema::create('lifestyle_user', function (Blueprint $table) {
            $table->id();

    // This will reference the 'users' table (assuming 'user_id' is meant to refer to users)
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

    // This should reference the 'lifestyles' table (not 'users')
    $table->foreignId('lifestyle_id')->constrained('lifestyles')->cascadeOnDelete();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifestyle_user');
    }
};

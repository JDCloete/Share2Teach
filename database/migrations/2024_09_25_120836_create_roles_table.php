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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();                                          // Primary key 'id'

            $table->string('role_name')->nullable();          // Role name like 'Educator', 'Admin', 'Moderator'
            $table->string('slug')->nullable();             // Optional slug for URL-friendly identifier, can be used if needed for routing
            $table->text('description')->nullable();        // Optional role description

            $table->timestamps();                                   // Adds created_at and updated_at timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

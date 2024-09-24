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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id');  // Primary key for the rating

            // Foreign Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key linking to the users table
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');  // Foreign key linking to the documents table

            $table->unsignedTinyInteger('rating_value');  // Rating value from 1 to 5

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};

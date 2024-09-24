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
        Schema::create('shares', function (Blueprint $table) {
            $table->id('share_id');  // Primary key for the share record

            // Foreign Key
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');  // Foreign key linking to the documents table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key linking to the users table

            $table->string('recipient_email', 255);  // Email address of the recipient

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};

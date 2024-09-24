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
        Schema::create('faq', function (Blueprint $table) {
            $table->id('faq_id');  // Primary key for the FAQ entry

            // Foreign Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key linking to users table

            $table->string('faq_question', 1024);  // The FAQ question, up to 1024 characters
            $table->text('faq_answer')->nullable();  // The FAQ answer, nullable in case it's not answered yet
            $table->timestamp('faq_date_created')->useCurrent();  // Date the FAQ was created

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};

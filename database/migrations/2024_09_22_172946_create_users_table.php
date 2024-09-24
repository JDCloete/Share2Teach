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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');  // Primary key, auto-incremented 'id' for the user
            $table->string('name', 255);  // User's first name
            $table->string('surname', 255);  // User's last name
            $table->string('email', 255)->unique();  // Email address, must be unique
            $table->string('password');  // Hashed password
            $table->timestamp('email_verified_at')->nullable();  // Timestamp when email was verified
            $table->timestamp('date_joined')->useCurrent();  // Timestamp of user registration, defaults to current time
            $table->boolean('email_verified')->default(false);  // Flag to indicate if the email is verified
            $table->rememberToken();  // Token for "remember me" functionality (default Laravel token)
            $table->softDeletes();  // Soft delete feature to allow the user to be marked as deleted

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

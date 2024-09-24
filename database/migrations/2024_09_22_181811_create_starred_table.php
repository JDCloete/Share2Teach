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
        Schema::create('starred', function (Blueprint $table) {
            $table->id('starred_id');  // Primary key for starred entry

            // Foreign Key
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');  // Foreign key linking to the documents table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key linking to the users table

            $table->timestamp('starred_at')->useCurrent();  // Timestamp for when the document was starred
            $table->boolean('is_favorite')->default(false);  // Marks whether the document is a favorite

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starred');
    }
};

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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id('analytics_id');  // Primary key for analytics entry

            // Foreign Key
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');  // Foreign key linking to the users table
            $table->unsignedInteger('user_count')->default(0);  // Tracks the number of users

            // Foreign Key
            $table->foreignId('document_id')->nullable()->constrained('documents')->onDelete('set null');  // Foreign key linking to the documents table
            $table->unsignedInteger('document_count')->default(0);  // Tracks the number of documents

            // Foreign Key
            $table->foreignId('report_id')->nullable()->constrained('reports')->onDelete('set null');  // Foreign key linking to the reports table
            $table->unsignedInteger('reported_documents_count')->default(0);  // Tracks the number of reported documents

            // Foreign Key
            $table->foreignId('download_id')->nullable()->constrained('downloads')->onDelete('set null');  // Foreign key linking to the downloads table
            $table->unsignedInteger('total_download_count')->default(0);  // Total download count for all documents

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};

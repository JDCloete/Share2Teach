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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('report_id');  // Primary key for the report

            $table->string('report_reason', 255);  // Reason for reporting, e.g., "Inappropriate Content"
            $table->text('report_description')->nullable();  // Detailed description of the report, nullable

            // Foreign Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key linking to the users table
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');  // Foreign key linking to the documents table

            $table->unsignedInteger('report_accepted_count')->default(0);  // Count of how many times the report was accepted
            $table->unsignedInteger('report_rejected_count')->default(0);  // Count of how many times the report was rejected

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

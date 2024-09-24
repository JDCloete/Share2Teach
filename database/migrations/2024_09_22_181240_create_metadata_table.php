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
        Schema::create('metadata', function (Blueprint $table) {
            $table->id('metadata_id');  // Primary key for metadata

            // Foreign Key
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');  // Foreign key linking to documents table

            $table->string('module_code', 7);  // Code of the module the document belongs to
            $table->string('category', 255);  // Category of the document (e.g., "lecture notes", "assignments")
            $table->year('academic_year');  // Year of the academic session (e.g., 2024)
            $table->string('lecturer_name', 255);  // Name of the lecturer associated with the document

            $table->timestamp('upload_date')->useCurrent();  // Date the document was uploaded

            $table->enum('type', ['pdf'])->default('pdf');  // Restrict type to only allow 'pdf'
            $table->unsignedBigInteger('size');  // File size in bytes

            $table->timestamps();  // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadata');
    }
};

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
        if (!Schema::hasTable('documents'))
        {
            Schema::create('documents', function (Blueprint $table) {

            $table->id('document_id');                                                               // Auto-incrementing document ID (primary key)
            $table->string('document_name',1024);                                             // Document name with a max length of 1024 characters
            $table->string('storage_path',1024)->nullable();                                   // Nullable storage path for the document
            $table->boolean('is_reported')->default(false);                                    // Boolean to indicate if the document has been reported

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');  // Document status

            // Foreign Key
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');    // Foreign key referencing the user who uploaded the document

            $table->float('document_rating_average', 3)->default(0.00);               // Average rating (3 digits total, 2 after decimal)
            $table->json('moderation_history')->nullable();                                          // JSON field to store moderation history
            $table->string('watermark_info')->nullable();                                            // Watermark information (nullable)
            $table->string('key',255);                                                        // Key for the file (if using a cloud storage)

            $table->timestamps();                                                                           // Created at and Updated at timestamps
        }
        );
    }}
    /**
     * moderation_history JSON field structure:
     * [
     * {
     * "action": "approved",
     * "moderator_id": 101,
     * "timestamp": "2024-09-22 14:32:00",
     * "reason": "No issues found",
     * "comments": "Approved after review"
     * },
     * {
     * "action": "rejected",
     * "moderator_id": 102,
     * "timestamp": "2024-09-23 10:15:00",
     * "reason": "Inappropriate content",
     * "comments": "Content flagged for inappropriate language"
     * }
     * ]
 */


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

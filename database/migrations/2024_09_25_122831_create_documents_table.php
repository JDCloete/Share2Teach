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

        Schema::create('documents', function (Blueprint $table) {

            $table->id();
            $table->string('document_name', 1024);
            $table->string('storage_path', 1024)->nullable();

            // Foreign keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('moderator_id')->nullable();
            $table->foreign('moderator_id')->references('id')->on('users')->onDelete('set null');

            $table->boolean('is_reviewed')->default(false);
            $table->float('document_rating_average', 3)->default(0.00);
            $table->string('watermark_info')->nullable();
            $table->string('key', 255);

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

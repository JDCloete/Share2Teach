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
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');

            $table->string('module_code', 7);
            $table->string('category', 255);
            $table->year('academic_year');
            $table->string('lecturer_name', 255);

            $table->timestamp('upload_date')->useCurrent();

            $table->enum('type', ['pdf'])->default('pdf');
            $table->unsignedBigInteger('size');

            $table->timestamps();
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

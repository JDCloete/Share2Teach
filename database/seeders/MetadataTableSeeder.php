<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetadataTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('metadata')->insert([
            [
                'document_id' => 1, // Ensure this document exists in the documents table
                'module_code' => 'CS101',
                'category' => 'Lecture Notes',
                'academic_year' => 2024,
                'lecturer_name' => 'Dr. Alice Smith',
                'upload_date' => Carbon::now(),
                'type' => 'pdf',
                'size' => 204800, // File size in bytes (200 KB)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_id' => 2, // Ensure this document exists in the documents table
                'module_code' => 'MA102',
                'category' => 'Assignments',
                'academic_year' => 2024,
                'lecturer_name' => 'Prof. Bob Johnson',
                'upload_date' => Carbon::now(),
                'type' => 'pdf',
                'size' => 512000, // File size in bytes (500 KB)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_id' => 3, // Ensure this document exists in the documents table
                'module_code' => 'PH103',
                'category' => 'Exam Papers',
                'academic_year' => 2024,
                'lecturer_name' => 'Dr. Charlie Brown',
                'upload_date' => Carbon::now(),
                'type' => 'pdf',
                'size' => 1048576, // File size in bytes (1 MB)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_id' => 4, // Ensure this document exists in the documents table
                'module_code' => 'EN104',
                'category' => 'Research Papers',
                'academic_year' => 2024,
                'lecturer_name' => 'Dr. Dana White',
                'upload_date' => now(),
                'type' => 'pdf',
                'size' => 307200, // File size in bytes (300 KB)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_id' => 5, // Ensure this document exists in the documents table
                'module_code' => 'HI105',
                'category' => 'Lecture Notes',
                'academic_year' => 2024,
                'lecturer_name' => 'Prof. Eva Green',
                'upload_date' => Carbon::now(),
                'type' => 'pdf',
                'size' => 256000, // File size in bytes (250 KB)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}


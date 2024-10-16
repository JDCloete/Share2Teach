<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('documents')->insert([
            [
                'document_name' => 'Project Report',
                'storage_path' => '/storage/documents/project_report.pdf',  // Nullable field
                'user_id' => 1,  // Assuming user with ID 1 uploaded the document
                'moderator_id' => 3,  // Assuming moderator with ID 3 reviewed it
                'is_reviewed' => false,
                'document_rating_average' => 4.75,
                'watermark_info' => 'Confidential',
                'key' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_name' => 'Design Document',
                'storage_path' => null,  // No storage path provided
                'user_id' => 2,  // User with ID 2 uploaded it
                'moderator_id' => null,  // Not yet reviewed
                'is_reviewed' => false,
                'document_rating_average' => 0.00,
                'watermark_info' => null,
                'key' => 'AKIAIOSFODNN7EXAMPLE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_name' => 'User Guide',
                'storage_path' => '/storage/documents/user_guide.pdf',
                'user_id' => 3,
                'moderator_id' => 2,
                'is_reviewed' => false,
                'document_rating_average' => 3.50,
                'watermark_info' => 'Property of S2T_Triple_Vision',
                'key' => 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_name' => 'User Guide',
                'storage_path' => '/storage/documents/user_guide.pdf',
                'user_id' => 3,
                'moderator_id' => 2,
                'is_reviewed' => false,
                'document_rating_average' => 3.50,
                'watermark_info' => 'Property of S2T_Triple_Vision',
                'key' => 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'document_name' => 'User Guide',
                'storage_path' => '/storage/documents/user_guide.pdf',
                'user_id' => 3,
                'moderator_id' => 2,
                'is_reviewed' => false,
                'document_rating_average' => 3.50,
                'watermark_info' => 'Property of S2T_Triple_Vision',
                'key' => 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reports')->insert([
            [
                'user_id' => 1,  // Assuming user with ID 1
                'document_id' => 1,  // Document with ID 1
                'report_reason' => 'Inappropriate content',
                'report_description' => 'The document contains offensive language.',
                'moderator_id' => null,  // No moderator assigned yet
                'action_taken' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,  // Assuming user with ID 2
                'document_id' => 2,  // Document with ID 2
                'report_reason' => 'Copyright infringement',
                'report_description' => 'The document violates copyright laws.',
                'moderator_id' => null,
                'action_taken' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'document_id' => 3,  // Document with ID 3
                'report_reason' => 'Spam',
                'report_description' => 'The document is promotional material.',
                'moderator_id' => 1,  // Assuming moderator with ID 1
                'action_taken' => 'denied',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,  // Assuming user with ID 3
                'document_id' => 1,
                'report_reason' => 'False information',
                'report_description' => 'The document contains misleading facts.',
                'moderator_id' => 2,  // Assuming moderator with ID 2
                'action_taken' => 'approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

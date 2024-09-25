<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnalyticsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('analytics')->insert([
            [
                'user_id' => 1,  // Assuming user with ID 1 is associated with these analytics
                'user_count' => 10,
                'document_count' => 5,
                'reported_documents_count' => 1,
                'total_download_count' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'user_count' => 20,
                'document_count' => 15,
                'reported_documents_count' => 2,
                'total_download_count' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => null,  // Anonymous analytics data
                'user_count' => 50,
                'document_count' => 30,
                'reported_documents_count' => 5,
                'total_download_count' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

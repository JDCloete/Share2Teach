<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DownloadsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('downloads')->insert([
            [
                'user_id' => 1,  // Assuming user with ID 1
                'document_id' => 1,  // Document with ID 1
                'download_count' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'document_id' => 2,  // Document with ID 2
                'download_count' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,  // Assuming user with ID 2
                'document_id' => 3,  // Document with ID 3
                'download_count' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,  // Assuming user with ID 3
                'document_id' => 1,
                'download_count' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'document_id' => 2,
                'download_count' => 0,  // No downloads yet
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

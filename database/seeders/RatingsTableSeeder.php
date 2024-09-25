<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'user_id' => 1,  // Assuming user with ID 1
                'document_id' => 1,  // Document with ID 1
                'rating_value' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'document_id' => 2,  // Document with ID 2
                'rating_value' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,  // Assuming user with ID 2
                'document_id' => 3,  // Document with ID 3
                'rating_value' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'document_id' => 1,
                'rating_value' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,  // Assuming user with ID 3
                'document_id' => 2,
                'rating_value' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

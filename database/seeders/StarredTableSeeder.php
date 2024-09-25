<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarredTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('starred')->insert([
            [
                'user_id' => 1,  // Assuming user with ID 1
                'document_id' => 1,  // Document with ID 1
                'starred_at' => Carbon::now(),
                'is_favorite' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'document_id' => 2,  // Document with ID 2
                'starred_at' => Carbon::now(),
                'is_favorite' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,  // Assuming user with ID 2
                'document_id' => 3,  // Document with ID 3
                'starred_at' => Carbon::now(),
                'is_favorite' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

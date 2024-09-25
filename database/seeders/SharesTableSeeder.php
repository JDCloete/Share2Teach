<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SharesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shares')->insert([
            [
                'user_id' => 1,  // Assuming user with ID 1
                'document_id' => 1,  // Document with ID 1
                'recipient_email' => 'recipient1@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,  // Assuming user with ID 2
                'document_id' => 2,  // Document with ID 2
                'recipient_email' => 'recipient2@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'document_id' => 3,  // Document with ID 3
                'recipient_email' => 'recipient3@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,  // Assuming user with ID 3
                'document_id' => null,  // No document shared
                'recipient_email' => 'recipient4@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => null,  // No user associated
                'document_id' => 2,
                'recipient_email' => 'recipient5@example.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

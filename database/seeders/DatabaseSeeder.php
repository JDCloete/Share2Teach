<?php

namespace Database\Seeders;

use App\Models\User;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            FaqTableSeeder::class,
            AnalyticsTableSeeder::class,
            DocumentsTableSeeder::class,
            MetadataTableSeeder::class,
            StarredTableSeeder::class,
            RatingsTableSeeder::class,
            DownloadsTableSeeder::class,
            ReportsTableSeeder::class,
            SharesTableSeeder::class,
        ]);
    }
}

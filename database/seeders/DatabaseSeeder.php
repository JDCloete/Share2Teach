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
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            DocumentsTableSeeder::class,
            ReportsTableSeeder::class,
            AnalyticsTableSeeder::class,
            SharesTableSeeder::class,
            RatingsTableSeeder::class,
            StarredTableSeeder::class,
            FaqTableSeeder::class,
            MetadataTableSeeder::class,
            DownloadsTableSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Danika',
                'surname' => 'le Roux',
                'email' => 'danikaleroux111@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('Admin123'),
                'role_id' => 1, // Admin role
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jean-luc',
                'surname' => 'Begue',
                'email' => 'jlbegue36@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('Admin456'),
                'role_id' => 2, // Educator role
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jacques',
                'surname' => 'Cloete',
                'email' => 'jacques14cloete@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('Admin789'),
                'role_id' => 3, // Moderator role
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

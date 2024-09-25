<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Educator',
                'slug' => 'educator',
                'description' => 'An Educator is the average user who has basic access to the system such as contributing files'
            ],
            [
                'role_name' => 'Admin',
                'slug' => 'admin',
                'description' => 'An Admin user has basic access to the system as well an analytics component.'

            ],
            [
                'role_name' => 'Moderator',
                'slug' => 'moderator',
                'description' => 'A Moderator also has basic access to the system but will do (Gate keeping, reviewing, approving/denying of documents)'
            ],
        ]);
    }
}

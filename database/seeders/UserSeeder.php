<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama_user' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'User',
                'email' => 'user@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
        ]);
    }
}
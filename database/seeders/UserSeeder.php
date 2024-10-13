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
                'nama_user' => 'Amin',
                'email' => 'amin@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'Udin',
                'email' => 'udin@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'Adit',
                'email' => 'adit@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'Joshua',
                'email' => 'Joshua@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'Dayat',
                'email' => 'Dayat@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'Fikri',
                'email' => 'Fikri1@example.com',
                'password' => bcrypt('admin123'),
                'role' => 1, // Admin
            ],
            [
                'nama_user' => 'User',
                'email' => 'user1@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
            [
                'nama_user' => 'Muhaidin',
                'email' => 'user2@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
            [
                'nama_user' => 'Latipah',
                'email' => 'user3@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
            [
                'nama_user' => 'Rizki',
                'email' => 'user4@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
            [
                'nama_user' => 'Maulana',
                'email' => 'user5@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
            [
                'nama_user' => 'Mohamed',
                'email' => 'user6@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
            [
                'nama_user' => 'Allcyn',
                'email' => 'user7@example.com',
                'password' => bcrypt('user123'),
                'role' => 2, // User
            ],
        ]);
    }
}
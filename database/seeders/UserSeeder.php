<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            //admin
            [
                'NIP' => '123456789123456789',
                'nama_user' => 'Admin',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
           
            //user//
        [
                'NIP' => '1237623',
                'nama_user' => 'User',
                'password' => bcrypt('user123'),
                'role' => 2,
            ],
        ]);
    }
}
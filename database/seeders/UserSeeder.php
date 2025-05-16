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
                'nama_user' => 'Admin Pendataan',
                'password' => bcrypt('pendataan123'),
                'role' => 1,
            ],
           
            //user//
        [
                'NIP' => '1237623',
                'nama_user' => 'User Pelayanan',
                'password' => bcrypt('pelayanan123'),
                'role' => 2,
            ],
        [
                'NIP' => '1237625',
                'nama_user' => 'User Pengarsipan',
                'password' => bcrypt('pengarsipan123'),
                'role' => 3,
            ],
        ]);
    }
}
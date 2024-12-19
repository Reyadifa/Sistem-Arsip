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
                'NIP' => '909208',
                'nama_user' => 'Dika',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
        [
                'NIP' => '1237623',
                'nama_user' => 'Windi',
                'password' => bcrypt('user123'),
                'role' => 2,
            ],
        ]);
    }
}
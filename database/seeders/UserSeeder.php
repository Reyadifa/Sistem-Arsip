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
                'nama_user' => 'Fikri',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '112233445566778899',
                'nama_user' => 'Dayat',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '123123456456789789',
                'nama_user' => 'Adit',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '121234345656787899',
                'nama_user' => 'Husein',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '123321456654789987',
                'nama_user' => 'Azhar',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '123231456546789879',
                'nama_user' => 'Udin',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '123123654456798879',
                'nama_user' => 'Agus',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '199128823773466455',
                'nama_user' => 'Joko',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '191928283737464655',
                'nama_user' => 'Dodo',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],
            [
                'NIP' => '192837465564738291',
                'nama_user' => 'Dika',
                'password' => bcrypt('admin123'),
                'role' => 1,
            ],


            //user//
        [
                'NIP' => '1237623',
                'nama_user' => 'Windi',
                'password' => bcrypt('user123'),
                'role' => 2,
            ],
        ]);
    }
}
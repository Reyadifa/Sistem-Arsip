<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Katering',
            ],
            [
                'nama_kategori' => 'Rumah Makan',
            ],
            [
                'nama_kategori' => 'Cafe',
            ],
            [
                'nama_kategori' => 'Restoran',
            ],
            [
                'nama_kategori' => 'Hotel',
            ],
            [
                'nama_kategori' => 'Kos',
            ],
            [
                'nama_kategori' => 'Olahraga',
            ],
            [
                'nama_kategori' => 'Parkiran',
            ],
            [
                'nama_kategori' => 'Guest House',
            ],
            [
                'nama_kategori' => 'Losmen',
            ],
        ]);
    }
}
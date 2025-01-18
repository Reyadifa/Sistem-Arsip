<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArsipSeeder extends Seeder
{
    public function run()
    {
        $kategoriId = 1; // Kategori yang sama
        $namaUsaha = 'Usaha Katering ABC'; // Nama usaha tetap sama
        $alamatUsaha = 'Jl. Katering No. 123, Banjarmasin, Kalimantan Selatan'; // Alamat usaha tetap sama
        $namaPemilik = 'John Doe'; // Nama pemilik tetap sama
        $alamatPemilik = 'Jl. Pemilik No. 456, Banjarmasin, Kalimantan Selatan'; // Alamat pemilik tetap sama
        $randomNpwp = '123456789'; // NPWP yang sama untuk kategori yang sama
        $filePath = 'uploads/usaha_katering_123.pdf'; // File path tetap sama

        // Daftar bulan dalam bahasa Indonesia
        $bulanNamaIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Data arsip yang akan dimasukkan
        $dataArsip = [
            ['bulan' => 'Januari', 'tahun' => 2022],
            ['bulan' => 'Februari', 'tahun' => 2022],
            ['bulan' => 'Maret', 'tahun' => 2022],
            ['bulan' => 'April', 'tahun' => 2022],
            ['bulan' => 'Mei', 'tahun' => 2022],
            ['bulan' => 'Juni', 'tahun' => 2022],
            ['bulan' => 'Juli', 'tahun' => 2022],
            ['bulan' => 'Agustus', 'tahun' => 2022],
            ['bulan' => 'September', 'tahun' => 2022],
            ['bulan' => 'Oktober', 'tahun' => 2022],
            ['bulan' => 'November', 'tahun' => 2022],
            ['bulan' => 'Desember', 'tahun' => 2022],

            ['bulan' => 'Januari', 'tahun' => 2023],
            ['bulan' => 'Februari', 'tahun' => 2023],
            ['bulan' => 'Maret', 'tahun' => 2023],
            ['bulan' => 'April', 'tahun' => 2023],
            ['bulan' => 'Mei', 'tahun' => 2023],
            ['bulan' => 'Juni', 'tahun' => 2023],
            ['bulan' => 'Juli', 'tahun' => 2023],
            ['bulan' => 'Agustus', 'tahun' => 2023]
        ];

        // Menyiapkan data arsip yang akan dimasukkan ke dalam database
        $arsipData = [];
        foreach ($dataArsip as $item) {
            $arsipData[] = [
                'id_kategori' => $kategoriId,
                'nama_usaha' => $namaUsaha,
                'alamat_usaha' => $alamatUsaha,
                'nama_pemilik' => $namaPemilik,
                'alamat_pemilik' => $alamatPemilik,
                'npwp' => $randomNpwp,
                'bulan' => $item['bulan'],
                'tahun' => $item['tahun'],
                'file_path' => $filePath,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Memasukkan data arsip ke tabel arsips
        DB::table('arsips')->insert($arsipData);
    }
}
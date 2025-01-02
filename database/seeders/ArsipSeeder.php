<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ArsipSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Locale untuk Indonesia
        $kategoris = DB::table('kategoris')->pluck('id_kategori'); // Mengambil id kategori dari tabel kategoris
        $totalData = 2000; // Total data yang diinginkan
        $dataPerBulanMin = 30; // Minimum arsip per bulan
        $dataPerBulanMax = 80; // Maksimum arsip per bulan

        $dataArsip = [];
        $tahunMulai = 2022; // Mulai dari tahun 2022
        $tahunAkhir = 2024; // Hingga tahun 2024

        // Loop untuk setiap bulan dari Januari 2022 hingga Desember 2024
        for ($tahun = $tahunMulai; $tahun <= $tahunAkhir; $tahun++) {
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                // Tentukan jumlah arsip untuk bulan ini antara 30 dan 80
                $jumlahArsipBulanIni = rand($dataPerBulanMin, $dataPerBulanMax);

                // Loop untuk membuat arsip sebanyak jumlah yang ditentukan untuk bulan ini
                for ($i = 1; $i <= $jumlahArsipBulanIni; $i++) {
                    // Pilih NPWP secara acak
                    $randomNpwp = str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);

                    // Pilih kategori secara acak (1 atau 2 kategori per NPWP)
                    $kategoriTerpilih = $faker->randomElements($kategoris->toArray(), rand(1, 2));

                    // Data pemilik dan usaha akan tetap sama untuk NPWP dan kategori yang sama
                    $namaPemilik = $faker->name;
                    $alamatPemilik = 'Jl. ' . $faker->streetName . ', ' . $faker->city . ', Kalimantan Selatan';
                    $alamatUsaha = 'Jl. ' . $faker->streetName . ', ' . $faker->city . ', Kalimantan Selatan';

                    foreach ($kategoriTerpilih as $kategoriId) {
                        // Nama usaha akan sama untuk satu kategori, jika NPWP dan kategori sama
                        $namaUsaha = 'Usaha ' . ($kategoriId == 1 ? 'Katering ' : 'Usaha ') . $faker->company;

                        // Format bulan agar nama bulannya sesuai dengan bahasa Indonesia
                        $bulanNamaIndo = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];

                        // Set file path agar tidak ada yang kosong
                        $filePath = 'uploads/usaha_' . ($tahun * 100 + $bulan * 10 + $i) . '.pdf';

                        // Masukkan data ke dalam array
                        $dataArsip[] = [
                            'id_kategori' => $kategoriId,
                            'nama_usaha' => $namaUsaha, // Nama usaha tetap sama untuk kategori yang sama
                            'alamat_usaha' => $alamatUsaha, // Alamat usaha tetap sama
                            'nama_pemilik' => $namaPemilik, // Nama pemilik tetap sama
                            'alamat_pemilik' => $alamatPemilik, // Alamat pemilik tetap sama
                            'npwp' => $randomNpwp, // NPWP yang sama untuk kategori yang sama
                            'bulan' => $bulanNamaIndo[$bulan], // Bulan sesuai
                            'tahun' => $tahun, // Tahun sesuai
                            'file_path' => $filePath, // File tidak boleh kosong
                            'created_at' => Carbon::now(), // Gunakan Carbon untuk waktu
                            'updated_at' => Carbon::now(), // Gunakan Carbon untuk waktu
                        ];
                    }

                    // Hentikan ketika mencapai total 2000 data
                    if (count($dataArsip) >= $totalData) {
                        break 2; // Keluar dari kedua loop jika sudah mencapai total data
                    }
                }
            }
        }

        DB::table('arsips')->insert($dataArsip); // Memasukkan data arsip ke tabel arsips
    }
}
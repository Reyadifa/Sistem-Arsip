<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArsipSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Locale untuk Indonesia
        $kategoris = DB::table('kategoris')->pluck('id_kategori'); // Mengambil id kategori dari tabel kategoris
        $jumlahNpwp = 50; // Membuat 50 NPWP unik
        $totalData = 1000; // Total data yang diinginkan
        $dataPerNpwp = ceil($totalData / $jumlahNpwp); // Rata-rata arsip per NPWP

        $dataArsip = [];
        $tahunMulai = 2020; // Mulai dari tahun 2020
        $bulanMulai = 1; // Mulai dari bulan Januari

        for ($npwpIndex = 1; $npwpIndex <= $jumlahNpwp; $npwpIndex++) {
            // Set random NPWP untuk setiap grup
            $randomNpwp = str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);

            // Pilih secara acak 1 atau 2 kategori untuk setiap NPWP
            $kategoriTerpilih = $faker->randomElements($kategoris->toArray(), rand(1, 2));

            // Data pemilik dan usaha akan tetap sama untuk NPWP dan kategori yang sama
            $namaPemilik = $faker->name;
            $alamatPemilik = 'Jl. ' . $faker->streetName . ', ' . $faker->city . ', Kalimantan Selatan';
            $alamatUsaha = 'Jl. ' . $faker->streetName . ', ' . $faker->city . ', Kalimantan Selatan';

            foreach ($kategoriTerpilih as $kategoriId) {
                // Nama usaha akan sama untuk satu kategori, jika NPWP dan kategori sama
                $namaUsaha = 'Usaha ' . ($kategoriId == 1 ? 'Katering ' : 'Usaha ') . $faker->company;

                // Loop untuk memastikan bahwa kita membuat jumlah data yang cukup
                for ($i = 1; $i <= $dataPerNpwp; $i++) {
                    // Set bulan dan tahun sesuai urutan
                    $bulan = $bulanMulai;
                    $tahun = $tahunMulai;

                    // Stop jika sudah mencapai Oktober 2024
                    if ($tahun == 2024 && $bulan > 10) {
                        break; // Keluar dari loop jika mencapai bulan November 2024 ke atas
                    }

                    // Format bulan agar nama bulannya sesuai dengan bahasa Indonesia
                    $namaBulan = date('F', mktime(0, 0, 0, $bulan, 10));
                    $bulanNamaIndo = [
                        'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
                        'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli',
                        'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober',
                        'November' => 'November', 'December' => 'Desember'
                    ];
                    $bulanIndo = $bulanNamaIndo[$namaBulan];

                    // Set file path agar tidak ada yang kosong
                    $filePath = 'uploads/usaha_' . ($npwpIndex * 100 + $i) . '.pdf';

                    // Masukkan data ke dalam array
                    $dataArsip[] = [
                        'id_kategori' => $kategoriId,
                        'nama_usaha' => $namaUsaha, // Nama usaha tetap sama untuk kategori yang sama
                        'alamat_usaha' => $alamatUsaha, // Alamat usaha tetap sama
                        'nama_pemilik' => $namaPemilik, // Nama pemilik tetap sama
                        'alamat_pemilik' => $alamatPemilik, // Alamat pemilik tetap sama
                        'npwp' => $randomNpwp, // NPWP yang sama untuk kategori yang sama
                        'bulan' => $bulanIndo, // Bulan berurutan
                        'tahun' => $tahun, // Tahun berurutan
                        'file_path' => $filePath, // File tidak boleh kosong
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Increment bulan setelah arsip dibuat
                    $bulanMulai++;

                    // Jika bulan mencapai lebih dari 12, reset bulan ke 1 dan tambah tahun
                    if ($bulanMulai > 12) {
                        $bulanMulai = 1;
                        $tahunMulai++;
                    }

                    // Hentikan ketika mencapai total 1000 data
                    if (count($dataArsip) >= 1000) {
                        break 3; // Keluar dari seluruh loop jika sudah mencapai 1000 data
                    }
                }
            }

            // Reset bulan dan tahun setelah setiap NPWP
            $bulanMulai = 1; // Reset bulan untuk NPWP berikutnya
            $tahunMulai = 2020; // Reset tahun untuk NPWP berikutnya
        }

        DB::table('arsips')->insert($dataArsip); // Memasukkan data arsip ke tabel arsips
    }
}
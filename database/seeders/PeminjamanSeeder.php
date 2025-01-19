<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Arsip;
use App\Models\User;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan arsip yang sudah ada
        $arsips = Arsip::all();
        // Mendapatkan user yang sudah ada
        $users = User::where('role', '!=', 'admin')->get(); // Ambil user yang bukan admin

        // Menambahkan data peminjaman
        foreach ($users as $user) {
            foreach ($arsips as $arsip) {
                // Cek apakah arsip sudah dipinjam
                $existingPeminjaman = Peminjaman::where('arsip_id', $arsip->id)
                                                ->where('status', 'Dipinjam')
                                                ->first();

                // Jika arsip belum dipinjam, maka bisa dipinjam
                if (!$existingPeminjaman) {
                    Peminjaman::create([
                        'nama_peminjam' => 'Adit',
                        'arsip_id' => $arsip->id,
                        'tgl_minjam' => Carbon::now()->subDays(rand(1, 30)), // Tanggal pinjam acak
                        'tgl_kembali' => Carbon::now()->addDays(rand(1, 30)), // Tanggal kembali acak
                        'status' => 'Dipinjam', // Status "Dipinjam"
                    ]);
                }
            }
        }
    }
}
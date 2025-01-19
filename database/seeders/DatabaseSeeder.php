<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Panggil PeminjamSeeder untuk mengisi tabel peminjam
        $this->call([
            KategoriSeeder::class,
            ArsipSeeder::class,
            UserSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
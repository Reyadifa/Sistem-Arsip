<?php

$arsips = [];
$namaUsaha = [
    "Katering Lezat", "Rumah Makan Sederhana", "Cafe Keren", "Restoran Enak", "Hotel Mewah",
    "Kedai Kopi", "Warung Makan", "Restoran Seafood", "Pusat Katering", "Kantin Sekolah",
    "Bubur Ayam", "Pasta Sederhana", "Pizza Hut", "Sushi Delight", "Salad Bar",
    "Tenda Biru", "Nasi Goreng Spesial", "Soto Betawi", "Gado-Gado", "Tahu Tempe",
    "Ayam Penyet", "Kue Cubir", "Roti Bakar", "Nasi Padang", "Nasi Kuning",
    "Kwetiau Goreng", "Sate Ayam", "Mie Goreng", "Kue Kering", "Kue Basah",
    "Minuman Segar", "Es Campur", "Sushi Roll", "Makanan Ringan", "Ayam Bakar",
    "Pasta Italia", "Steak Lezat", "Salad Sayuran", "Minuman Tradisional", "Pasta Kesehatan",
    "Pasta Cepat Saji", "Nasi Uduk", "Sate Kambing", "Nasi Biryani", "Mie Aceh",
    "Makanan Penutup", "Kue Tar", "Kue Lumpur", "Martabak Manis", "Sushi Roll",
    "Ayam Goreng", "Kue Cubir", "Keripik Sayuran", "Minuman Biji Kelor", "Kue Srikaya"
];

// Buat 1000 arsip dengan nama usaha acak
for ($i = 1; $i <= 1000; $i++) {
    $randomNamaUsaha = $namaUsaha[array_rand($namaUsaha)];
    $idKategori = rand(1, 10); // Asumsikan ada 10 kategori
    $bulan = date('F', mktime(0, 0, 0, rand(1, 12), 1)); // Ambil bulan acak
    $tahun = rand(2021, 2024); // Tahun acak antara 2021 dan 2024
    
    $arsips[] = "[ 
        'id_kategori' => $idKategori, 
        'nama_usaha' => '$randomNamaUsaha', 
        'alamat_usaha' => 'Jl. $randomNamaUsaha No. $i, Kota', 
        'nama_pemilik' => 'Pemilik $i', 
        'alamat_pemilik' => 'Jl. Pemilik No. $i, Kota', 
        'npwp' => '" . str_pad($i, 15, '0', STR_PAD_LEFT) . "', 
        'bulan' => '$bulan', 
        'tahun' => $tahun, 
        'file_path' => 'uploads/arsip_$i.pdf', 
        'created_at' => now(), 
        'updated_at' => now(), 
    ],";
}

// Tampilkan hasilnya
echo implode("\n", $arsips);
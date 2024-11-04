<?php

$users = [];
$firstNames = [
    "Ahmad", "Budi", "Candra", "Dika", "Eko", "Farhan", "Galih", "Hadi", "Irfan", "Jaya",
    "Kurnia", "Luthfi", "Miko", "Nanda", "Oji", "Pandi", "Qori", "Rudi", "Sandi", "Taufik",
    "Umar", "Vira", "Wira", "Yudi", "Zain", "Ali", "Bella", "Cici", "Dini", "Eni",
    "Fina", "Gita", "Hani", "Intan", "Jeni", "Kiki", "Lila", "Mira", "Nia", "Oka",
    "Pika", "Qila", "Rina", "Sari", "Tika", "Umi", "Vina", "Wulan", "Yanti", "Zulaikha",
    "Dimas", "Rizky", "Fadil", "Damar", "Gilang", "Iqbal", "Reza", "Dodi", "Dani", "Dhea",
    "Leni", "Dika", "Zaki", "Tami", "Ega", "Adi", "Bima", "Luthfi", "Elok", "Rafi",
    "Salsa", "Tori", "Devi", "Rina", "Windi", "Restu", "Mela", "Hendra", "Bintang", "Elvira",
    "Hanif", "Kevin", "Dinda", "Siti", "Muna", "Rendy", "Citra", "Ferry", "Ghina", "Fikri",
    "Reza", "Sandy", "Anisa", "Gani", "Kila", "Riko", "Wulan", "Mutiara", "Farah", "Icha"
];

// Buat 10 admin dengan nama acak
for ($i = 1; $i <= 10; $i++) {
    $randomFirstName = $firstNames[array_rand($firstNames)];
    $users[] = "[
        'nama_user' => '$randomFirstName',
        'email' => 'admin$i@example.com',
        'password' => bcrypt('admin123'),
        'role' => 1,
    ],";
}

// Buat 100 user dengan nama acak
for ($i = 1; $i <= 100; $i++) {
    $randomFirstName = $firstNames[array_rand($firstNames)];
    $users[] = "[
        'nama_user' => '$randomFirstName',
        'email' => 'user$i@example.com',
        'password' => bcrypt('user123'),
        'role' => 2,
    ],";
}

// Tampilkan hasilnya
echo implode("\n", $users);
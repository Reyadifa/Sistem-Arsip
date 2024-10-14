<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Arsip</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- tailwind config --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-20 flex">
    <div class="flex w-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-500 to-blue-700 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">Manajemen Arsip</h2>
            <hr>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="/arsip" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                            <span class="material-icons">archive</span>
                            <span class="ml-2">Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="/kategori" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                            <span class="material-icons">category</span>
                            <span class="ml-2">Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="/users" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                            <span class="material-icons">person</span>
                            <span class="ml-2">User</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Form Tambah Arsip -->
        <div class="flex-grow bg-white p-6">
            <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl mb-4">Tambah Arsip</h1>
            <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf

                <div class="mb-4">
                    <label for="id_kategori" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="npwp" class="block mb-2 text-sm font-medium text-gray-700">NPWP</label>
                    <input type="text" name="npwp" id="npwp" placeholder="Masukkan NPWP" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="mb-4">
                    <label for="nama_usaha" class="block mb-2 text-sm font-medium text-gray-700">Nama Usaha</label>
                    <input type="text" name="nama_usaha" id="nama_usaha" placeholder="Masukkan Nama Usaha" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="mb-4">
                    <label for="alamat_usaha" class="block mb-2 text-sm font-medium text-gray-700">Alamat Usaha</label>
                    <input type="text" name="alamat_usaha" id="alamat_usaha" placeholder="Masukkan Alamat Usaha" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="mb-4">
                    <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-700">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Masukkan Nama Pemilik" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="mb-4">
                    <label for="alamat_pemilik" class="block mb-2 text-sm font-medium text-gray-700">Alamat Pemilik</label>
                    <input type="text" name="alamat_pemilik" id="alamat_pemilik" placeholder="Masukkan Alamat Pemilik" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="mb-4">
                    <label for="bulan" class="block mb-2 text-sm font-medium text-gray-700">Bulan</label>
                    <select name="bulan" id="bulan" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                        <option value="" disabled selected>Pilih Bulan</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tahun" class="block mb-2 text-sm font-medium text-gray-700">Tahun</label>
                    <input type="number" name="tahun" id="tahun" placeholder="Masukkan Tahun" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-black" required>
                </div>

                <div class="mb-4">
                    <label for="file" class="block mb-2 text-sm font-medium text-gray-700">Upload File</label>
                    <input type="file" name="file" id="file" class="w-full rounded-lg border border-black p-3 text-sm focus:outline-none focus:ring-2 focus:ring-white" required>
                </div>
                

                <div class="justify-left flex space-x-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">Simpan</button>
                    <a href="/arsip" class="bg-blue-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition text-center">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


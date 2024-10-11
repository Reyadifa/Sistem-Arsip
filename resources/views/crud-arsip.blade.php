<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Arsip</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg max-w-2xl w-full">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Tambah Arsip</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('arsip.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori" name="kategori" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        <option value="hotel">Hotel</option>
                        <option value="rumah makan">Rumah Makan</option>
                        <option value="restoran">Restoran</option>
                        <option value="cafe">Cafe</option>
                        <option value="katering">Katering</option>
                    </select>
                </div>

                <div>
                    <label for="nama_usaha" class="block text-sm font-medium text-gray-700">Nama Usaha</label>
                    <input type="text" id="nama_usaha" name="nama_usaha" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="alamat_usaha" class="block text-sm font-medium text-gray-700">Alamat Usaha</label>
                    <input type="text" id="alamat_usaha" name="alamat_usaha" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="alamat_pemilik" class="block text-sm font-medium text-gray-700">Alamat Pemilik</label>
                    <input type="text" id="alamat_pemilik" name="alamat_pemilik" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                    <input type="text" id="npwp" name="npwp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="bulan" name="bulan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Bulan</option>
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

                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <input type="text" id="tahun" name="tahun" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-500">
                        Tambah Arsip
                    </button>
                </div>

            </div>
        </form>
    </div>

</body>
</html>
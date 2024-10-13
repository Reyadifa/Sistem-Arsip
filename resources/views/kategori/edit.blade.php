<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-gray-50">

<div class="flex h-screen">
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

    <!-- Konten Utama -->
    <main class="flex-grow p-8 bg-gray-100">
        <div class="max-w-10xl mx-50 bg-white shadow-xl rounded-lg p-20">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Kategori</h1>

            <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">Simpan</button>
            </form>
        </div>
    </main>
</div>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
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
        <div class="max-w-10xl mx-auto bg-white shadow-xl rounded-lg p-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Kategori</h1>

            <!-- Pesan Sukses atau Error -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('kategori.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Tambah Kategori</a>
                <input type="text" placeholder="Cari kategori..." class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="overflow-hidden bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($kategoris as $kategori)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kategori->nama_kategori }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-4 justify-center">
                                        <a href="{{ route('kategori.edit', $kategori->id_kategori) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-4 rounded-lg transition">Edit</a>
                                        <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded-lg transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $kategoris->links() }}
            </div>
        </div>
    </main>
</div>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- link awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    {{-- config tailwind --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Konten Utama -->
        <main class="flex-grow p-8 bg-gray-100">
            <div class="max-w-10xl mx-auto bg-white shadow-xl rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Kategori</h1>

                <!-- Pesan Sukses atau Error -->

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-6 flex justify-between items-center">
                    <a href="{{ route('kategori.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition"><i
                            class="fa-solid fa-plus mr-2 font-bold text-lg"></i> Tambah Kategori</a>
                    <input type="text" placeholder="Cari kategori..."
                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-500">
                </div>

                <div class="overflow-hidden bg-white shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Nama
                                    Kategori</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-4 justify-center">
                                            {{-- edit --}}
                                            <a href="{{ route('kategori.edit', $kategori->id_kategori) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold  rounded-lg transition py-2 px-8"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            {{-- js nya di sini --}}
                                            <form id="delete-form-{{ $kategori->id_kategori }}"
                                                action="{{ route('kategori.destroy', $kategori->id_kategori) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                {{-- hapus --}}
                                                @method('DELETE')
                                                <button type="button"
                                                    class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg"
                                                    onclick="confirmDelete({{ $kategori->id_kategori }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
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
    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- js kategori --}}
    <script src="{{ asset('js/kategori.js') }}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Arsip</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen">

    <div class="flex min-h-screen">

        {{-- Include sidebar --}}

        @include('layouts.sidebar')

        <main class="flex-1 p-8 bg-gray-200">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-700 text-white text-center py-4">
                    <h1 class="text-4xl font-bold">Detail Arsip</h1>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4">Informasi Arsip</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Kategori:</p>
                                <p>{{ $kategori->nama_kategori }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Nama Usaha:</p>
                                <p>{{ $arsip->nama_usaha }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Alamat Usaha:</p>
                                <p>{{ $arsip->alamat_usaha }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Nama Pemilik:</p>
                                <p>{{ $arsip->nama_pemilik }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Alamat Pemilik:</p>
                                <p>{{ $arsip->alamat_pemilik }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">NPWP:</p>
                                <p>{{ $arsip->npwp }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Bulan:</p>
                                <p>{{ $arsip->bulan }}</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-md border-l-4 border-blue-500">
                                <p class="font-bold">Tahun:</p>
                                <p>{{ $arsip->tahun }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4">File Terlampir</h2>
                        @if ($arsip->file_path)
                            <div class="flex items-center space-x-4">
                                <a href="{{ asset('storage/' . $arsip->file_path) }}"
                                    class="text-blue-600 hover:underline" target="_blank">Lihat File</a>
                                <span class="text-gray-500">|</span>
                                <button
                                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-150">Download</button>
                            </div>
                        @else
                            <p>Tidak ada file yang diunggah.</p>
                        @endif
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('arsip.edit', $arsip->id) }}"
                            class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-150">Edit</a>
                        <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-150">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>

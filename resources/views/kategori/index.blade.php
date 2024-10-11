<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <div class="flex flex-col h-full w-60 bg-blue-50 text-gray-800"> <!-- Sidebar -->
        <div class="space-y-3 flex-grow">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Arsip</h2>
                <button class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-600">
                        <rect width="352" height="32" x="80" y="96"></rect>
                        <rect width="352" height="32" x="80" y="240"></rect>
                        <rect width="352" height="32" x="80" y="384"></rect>
                    </svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto">
                <ul class="pt-2 pb-4 space-y-1 text-sm">
                    <li class="rounded-sm">
                        <a rel="noopener noreferrer" href="/arsip" class="flex items-center p-2 space-x-3 rounded-md hover:bg-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-600">
                                <path d="M469.666,216.45,271.078,33.749a34,34,0,0,0-47.062.98L41.373,217.373,32,226.745V496H208V328h96V496H480V225.958ZM248.038,56.771c.282,0,.108.061-.013.18C247.9,56.832,247.756,56.771,248.038,56.771ZM448,464H336V328a32,32,0,0,0-32-32H208a32,32,0,0,0-32,32V464H64V240L248.038,57.356c.013-.012.014-.023.024-.035L448,240Z"></path>
                            </svg>
                            <span>Arsip</span>
                        </a>
                    </li>
                    <li class="rounded-sm">
                        <a rel="noopener noreferrer" href="/kategori" class="flex items-center p-2 space-x-3 rounded-md hover:bg-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-600">
                                <path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z"></path>
                            </svg>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li class="rounded-sm">
                        <a rel="noopener noreferrer" href="#" class="flex items-center p-2 space-x-3 rounded-md hover:bg-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-gray-600">
                                <path d="M448.205,392.507c30.519-27.2,47.8-63.455,47.8-101.078,0-39.984-18.718-77.378-52.707-105.3C410.218,158.963,366.432,144,320,144s-90.218,14.963-123.293,42.131C162.718,214.051,144,251.445,144,291.429s18.718,77.378,52.707,105.3c33.075,27.168,76.861,42.13,123.293,42.13,6.187,0,12.412-.273,18.585-.816l10.546,9.141A199.849,199.849,0,0,0,480,496h16V461.943l-4.686-4.685A199.17,199.17,0,0,1,448.205,392.507ZM370.089,423l-21.161-18.341-7.056.865A180.275,180.275,0,0,1,320,406.857c-79.4,0-144-51.781-144-115.428S240.6,176,320,176s144,51.781,144,115.429c0,31.71-15.82,61.314-44.546,83.358l-9.215,7.071,4.252,12.035a231.287,231.287,0,0,0,37.882,67.817A167.839,167.839,0,0,1,370.089,423Z"></path>
                                <path d="M60.185,317.476a220.491,220.491,0,0,0,34.808-63.023l4.22-11.975-9.207-7.066C62.918,214.626,48,186.728,48,156.857,48,96.442,112.178,48,192,48s144,48.442,144,108.857c0,24.33-8.89,47.44-24.73,66.944-7.82,10.029-16.663,18.838-26.077,26.418l-7.056-4.547a204.969,204.969,0,0,0-44.342-12.586c-31.014,0-61.476,6.4-88.026,17.265-6.76,2.46-12.782,5.29-18.463,8.193a178.758,178.758,0,0,0,21.75,4.38c23.476,1.275,45.568,5.574,66.547,12.167A188.749,188.749,0,0,0,60.185,317.476Z"></path>
                            </svg>
                            <span>User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-4 flex-grow"> <!-- Kontainer utama -->
        <h1 class="text-2xl font-bold mb-4">Daftar Kategori</h1>

        <!-- Menampilkan pesan sukses atau error -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('kategori.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Tambah Kategori</a>

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($kategoris as $kategori)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kategori->id_kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kategori->nama_kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="{{ route('kategori.edit', $kategori->id_kategori) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
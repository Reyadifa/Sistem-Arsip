<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
    </form>
</div>

</body>
</html>
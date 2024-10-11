<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Arsip</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detail Arsip</h1>

    <div class="bg-white p-4 rounded shadow-md">
        <p><strong>Kategori:</strong> {{ $kategori->nama_kategori }}</p>
        <p><strong>Nama Usaha:</strong> {{ $arsip->nama_usaha }}</p>
        <p><strong>Alamat Usaha:</strong> {{ $arsip->alamat_usaha }}</p>
        <p><strong>Nama Pemilik:</strong> {{ $arsip->nama_pemilik }}</p>
        <p><strong>Alamat Pemilik:</strong> {{ $arsip->alamat_pemilik }}</p>
        <p><strong>NPWP:</strong> {{ $arsip->npwp }}</p>
        <p><strong>Bulan:</strong> {{ $arsip->bulan }}</p>
        <p><strong>Tahun:</strong> {{ $arsip->tahun }}</p>
        <p><strong>File:</strong>
            @if ($arsip->file_path)
                <a href="{{ Storage::url($arsip->file_path) }}" target="_blank" class="text-blue-500">Lihat File</a>
            @else
                Tidak ada file
            @endif
        </p>
        <a href="{{ route('arsip.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
    </div>
</div>

</body>
</html>
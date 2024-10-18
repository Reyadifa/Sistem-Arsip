<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Arsip</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-white">
    <div class="flex min-h-screen">

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-grow p-6">
            <h1 class="text-center text-2xl font-bold text-blue-700 sm:text-3xl mb-8">Edit Arsip</h1>

            <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <label for="id_kategori" class="block text-sm font-medium text-gray-600">Kategori</label>
                    <select name="id_kategori" id="id_kategori"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ $kategori->id_kategori == $arsip->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="nama_usaha" class="block text-sm font-medium text-gray-600">Nama Usaha</label>
                    <input type="text" name="nama_usaha" id="nama_usaha" value="{{ $arsip->nama_usaha }}"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                </div>

                <div>
                    <label for="alamat_usaha" class="block text-sm font-medium text-gray-600">Alamat Usaha</label>
                    <input type="text" name="alamat_usaha" id="alamat_usaha" value="{{ $arsip->alamat_usaha }}"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                </div>

                <div>
                    <label for="nama_pemilik" class="block text-sm font-medium text-gray-600">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ $arsip->nama_pemilik }}"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                </div>

                <div>
                    <label for="alamat_pemilik" class="block text-sm font-medium text-gray-600">Alamat Pemilik</label>
                    <input type="text" name="alamat_pemilik" id="alamat_pemilik" value="{{ $arsip->alamat_pemilik }}"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                </div>

                <div>
                    <label for="npwp" class="block text-sm font-medium text-gray-600">NPWP</label>
                    <input type="text" name="npwp" id="npwp" value="{{ $arsip->npwp }}"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                </div>

                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-600">Bulan</label>
                    <select name="bulan" id="bulan"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                        <option value="Januari" {{ $arsip->bulan == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ $arsip->bulan == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ $arsip->bulan == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ $arsip->bulan == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ $arsip->bulan == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ $arsip->bulan == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ $arsip->bulan == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ $arsip->bulan == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ $arsip->bulan == 'September' ? 'selected' : '' }}>September
                        </option>
                        <option value="Oktober" {{ $arsip->bulan == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ $arsip->bulan == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ $arsip->bulan == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>

                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-600">Tahun</label>
                    <input type="text" name="tahun" id="tahun" value="{{ $arsip->tahun }}"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black" required>
                </div>

                <div>
                    <label for="file" class="block text-sm font-medium text-gray-600">File</label>
                    <input type="file" name="file" id="file"
                        class="w-full rounded-lg border-gray-300 p-4 text-sm shadow-sm bg-gray-100 text-black">
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>

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

<body class="bg-gray-20">
    <div class="flex ml-40">

        <!--include Sidebar -->

        @include('layouts.sidebar')

        <!-- Form Tambah Arsip -->
        <div class="flex-grow">

            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">archive</span>

                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">Admin |</h2>
                        <div class="bg-black rounded-full h-14 w-14"></div>
                    </div>
                </div>
            </div>

            <main class=" p-10 mx-32 mt-10">

                <div
                    class="text-center text-2xl font-bold  sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                    <span class="material-icons text-blue-500 text-4xl ">archive</span>
                    <h1>Tambah Arsip</h1>
                </div>

                <hr class="border-2 border-gray-500 w-[600px] mx-auto">
                <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Pesan Kesalahan --}}
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="bg-red-200 border border-red-600 text-red-600 p-3 rounded-lg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif



                    {{-- Kotak --}}
                    <main class="grid grid-cols-2 gap-x-6 mt-1 ">

                        <div class="mb-4 mt-10 ">
                            <label for="id_kategori" class="block mb-2 text-sm font-bold text-black ">Kategori</label>

                            {{-- Kategori --}}
                            <select name="id_kategori" id="id_kategori"
                                class="w-full rounded-lg   p-3 text-sm focus:outline-none focus:ring-2 border border-gray-500"
                                required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Npwp --}}
                        <div class="mb-4 mt-10">
                            <label for="npwp" class="block mb-2 text-sm font-bold text-black">NPWP</label>
                            <input type="text" name="npwp" id="npwp" placeholder="Masukkan NPWP"
                                class="w-full rounded-lg border  p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                value="{{ old('npwp') }}" required>
                        </div>


                        {{-- Nama Usaha --}}
                        <div class="mb-4 ">
                            <label for="nama_usaha" class="block mb-2 text-sm font-bold text-black">Nama
                                Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" placeholder="Masukkan Nama Usaha"
                                class="w-full rounded-lg border  p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                value="{{ old('nama_usaha') }}" required>
                        </div>
                        {{-- Alamat Usaha --}}
                        <div class="mb-4 ">
                            <label for="alamat_usaha" class="block mb-2 text-sm font-bold text-black">Alamat
                                Usaha</label>
                            <input type="text" name="alamat_usaha" id="alamat_usaha"
                                placeholder="Masukkan Alamat Usaha"
                                class="w-full rounded-lg border  p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                value="{{ old('alamat_usaha') }}" required>
                        </div>

                        {{-- Nama Pemilik --}}
                        <div class="mb-4 ">
                            <label for="nama_pemilik" class="block mb-2 text-sm font-bold text-black">Nama
                                Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik"
                                placeholder="Masukkan Nama Pemilik"
                                class="w-full rounded-lg border  p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                value="{{ old('nama_pemilik') }}" required>
                        </div>

                        {{-- Alamat Pemilik --}}
                        <div class="mb-4 ">
                            <label for="alamat_pemilik" class="block mb-2 text-sm font-bold text-black">Alamat
                                Pemilik</label>
                            <input type="text" name="alamat_pemilik" id="alamat_pemilik"
                                placeholder="Masukkan Alamat Pemilik"
                                class="w-full rounded-lg border  p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                value="{{ old('alamat_pemilik') }}" required>
                        </div>

                        {{-- Bulan --}}
                        <div class="mb-4 ">
                            <label for="bulan" class="block mb-2 text-sm font-bold text-black">Bulan</label>
                            <select name="bulan" id="bulan"
                                class="w-full rounded-lg border   p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                required>
                                <option value="" disabled {{ old('bulan') ? '' : 'selected' }}>Pilih Bulan
                                </option>
                                <option value="Januari" {{ old('bulan') == 'Januari' ? 'selected' : '' }}>Januari
                                </option>
                                <option value="Februari" {{ old('bulan') == 'Februari' ? 'selected' : '' }}>Februari
                                </option>
                                <option value="Maret" {{ old('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                                <option value="April" {{ old('bulan') == 'April' ? 'selected' : '' }}>April</option>
                                <option value="Mei" {{ old('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                                <option value="Juni" {{ old('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                                <option value="Juli" {{ old('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                                <option value="Agustus" {{ old('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus
                                </option>
                                <option value="September" {{ old('bulan') == 'September' ? 'selected' : '' }}>September
                                </option>
                                <option value="Oktober" {{ old('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober
                                </option>
                                <option value="November" {{ old('bulan') == 'November' ? 'selected' : '' }}>November
                                </option>
                                <option value="Desember" {{ old('bulan') == 'Desember' ? 'selected' : '' }}>Desember
                                </option>
                            </select>
                        </div>

                        {{-- Tahun --}}
                        <div class="mb-4 ">
                            <label for="tahun" class="block mb-2 text-sm font-bold text-black">Tahun</label>
                            <input type="number" name="tahun" id="tahun" placeholder="Masukkan Tahun"
                                class="w-full rounded-lg border  p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                                value="{{ old('tahun') }}" required>
                        </div>



                    </main>



                    {{-- Upload File --}}

                    <div class="mb-4">
                        <label for="file" class="block mb-2 text-sm font-bold text-black ">Upload File</label>
                        <input type="file" name="file" id="file"
                            class="w-full rounded-lg border  bg-white p-3 text-sm focus:outline-none focus:ring-2 border-gray-500"
                            required>
                    </div>


                    {{-- Button Simpan dan Kembali --}}


                    <div class="justify-left flex space-x-4 mt-14">
                        <button type="submit"
                            class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600  text-xl font-semibold transform transition-transform duration-300 hover:scale-110">Simpan</button>
                        <a href="/arsip"
                            class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">Kembali</a>
                    </div>
                </form>
        </div>
    </div>

    </main>


</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Arsip</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-20">
    <div class="flex ml-40">
        @include('layouts.sidebar')

        <div class="flex-grow">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">archive</span>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white "></i>
                        </div>
                    </div>
                </div>
            </div>

            <main class="p-10 mx-32 mt-6">
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

                <div class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                    <span class="material-icons text-blue-500 text-4xl ">archive</span>
                    <h1>Tambah Arsip</h1>
                </div>

                <hr class="border-2 border-gray-500 w-[600px] mx-auto">

                <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <main class="w-full mt-1">

                        {{-- Usaha --}}
                        <div class="mb-4 mt-10">
                            <label for="usaha_id" class="block mb-2 text-sm font-bold text-black">Pilih Usaha</label>
                            <select name="usaha_id" id="usaha_id"
                                class="w-full rounded-lg p-3 text-sm border border-gray-500" required>
                                <option value="" disabled selected>Pilih Usaha</option>
                                @foreach ($usahas as $usaha)
                                    <option value="{{ $usaha->id }}" {{ old('usaha_id') == $usaha->id ? 'selected' : '' }}>
                                        {{ $usaha->npwp }} - {{ $usaha->nama_usaha }} ({{ $usaha->nama_pemilik }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Bulan --}}
                        <div class="mb-4">
                            <label for="bulan" class="block mb-2 text-sm font-bold text-black">Bulan</label>
                            <select name="bulan" id="bulan"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500" required>
                                <option value="" disabled {{ old('bulan') ? '' : 'selected' }}>Pilih Bulan</option>
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tahun --}}
                        <div class="mb-4">
                            <label for="tahun" class="block mb-2 text-sm font-bold text-black">Tahun</label>
                            <input type="number" name="tahun" id="tahun" placeholder="Masukkan Tahun"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500"
                                value="{{ old('tahun') }}" required>
                        </div>
                    </main>

                    {{-- File Upload --}}
                    <div class="mb-4">
                        <label for="file" class="block mb-2 text-sm font-bold text-black">Upload File</label>
                        <input type="file" name="file" id="file"
                            class="w-full rounded-lg border bg-white p-3 text-sm border-gray-500" required>
                    </div>

                    {{-- Tombol --}}
                    <div class="justify-left flex space-x-4 mt-14">
                        <button type="submit"
                            class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                            Simpan
                        </button>
                        <a href="{{ route('arsip.index') }}"
                            class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                            Kembali
                        </a>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>

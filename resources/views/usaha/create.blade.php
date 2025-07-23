<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Usaha</title>
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
                    <span class="material-icons text-4xl text-white">add_business</span>
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
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                    <span class="material-icons text-blue-500 text-4xl">add_business</span>
                    <h1>Tambah Usaha</h1>
                </div>

                <hr class="border-2 border-gray-500 w-[600px] mx-auto mb-8">

                <form action="{{ route('usahas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-x-6">
                        <div class="mb-4">
                            <label for="npwp" class="block mb-2 text-sm font-bold text-black">NPWP</label>
                            <input type="text" name="npwp" id="npwp" placeholder="Masukkan NPWP"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500 focus:ring focus:ring-blue-300"
                                value="{{ old('npwp') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="nama_usaha" class="block mb-2 text-sm font-bold text-black">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" placeholder="Masukkan Nama Usaha"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500 focus:ring focus:ring-blue-300"
                                value="{{ old('nama_usaha') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="alamat_usaha" class="block mb-2 text-sm font-bold text-black">Alamat Usaha</label>
                            <input type="text" name="alamat_usaha" id="alamat_usaha" placeholder="Masukkan Alamat Usaha"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500 focus:ring focus:ring-blue-300"
                                value="{{ old('alamat_usaha') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="nama_pemilik" class="block mb-2 text-sm font-bold text-black">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Masukkan Nama Pemilik"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500 focus:ring focus:ring-blue-300"
                                value="{{ old('nama_pemilik') }}" required>
                        </div>

                        <div class="mb-4 col-span-2">
                            <label for="alamat_pemilik" class="block mb-2 text-sm font-bold text-black">Alamat Pemilik</label>
                            <input type="text" name="alamat_pemilik" id="alamat_pemilik" placeholder="Masukkan Alamat Pemilik"
                                class="w-full rounded-lg border p-3 text-sm border-gray-500 focus:ring focus:ring-blue-300"
                                value="{{ old('alamat_pemilik') }}" required>
                        </div>
                    </div>

                    <div class="flex space-x-4 mt-10">
                        <button type="submit"
                            class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                            Simpan
                        </button>
                        <a href="{{ route('usahas.index') }}"
                            class="bg-gray-400 text-white px-6 py-3 rounded-lg hover:bg-gray-500 text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                            Kembali
                        </a>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
</html>

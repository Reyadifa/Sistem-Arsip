@extends('layouts.app')

@section('content')
    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1  bg-gray-100 ">
            <div>
                <div class="bg-blue-600 py-14">
                    <div class="flex items-center">
                        <span class="material-icons text-4xl text-white"></span>
                        <div class="absolute right-8 flex items-center gap-4">
                            <h2 class="text-4xl font-bold ml-3 text-white ">Admin |</h2>
                            <div class="bg-black rounded-full h-14 w-14"></div>
                        </div>
                    </div>
                </div>
                <div class="max-w-10xl mx-50 bg-white shadow-xl rounded-lg p-20">
                    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Tambah Kategori</h1>

                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>
                        <div class="grid grid-cols-2 gap-8 w-96 mt-16">
                            <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200 hover:scale-110">Simpan</button>
                            <a href="/kategori"
                                class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-200 hover:scale-110">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    @endsection

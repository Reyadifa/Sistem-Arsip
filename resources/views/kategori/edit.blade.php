@extends('layouts.app')

@section('content')
    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 ">

            <div class="bg-blue-600 py-14">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white"></span>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">Admin |</h2>
                        <div class="bg-black rounded-full h-14 w-14"></div>
                    </div>
                </div>
            </div>

            {{-- Form edit --}}
            <div class="max-w-10xl mx-50 rounded-lg p-32">
                <div
                    class="text-center text-2xl font-bold  sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                    <span class="material-icons text-blue-500 text-4xl">category</span>
                    <h1>Edit Ktegori</h1>
                </div>
                <hr class="border-2 border-gray-500 mb-10 w-[600px] mx-auto">

                <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}"
                            class="mt-1 block w-full border border-gray-500 rounded-md shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            required>
                    </div>
                    <div class="grid grid-cols-2 gap-8 w-96 mt-10">
                        <button id="edit" type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition transform duration-200 hover:scale-110 ">Simpan</button>
                        <button
                            class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-200 hover:scale-110">
                            <a href="/kategori" class="">Kembali</a>
                        </button>
                    </div>
                </form>

            </div>

        </div>
    @endsection

@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-grow">
            <div class="bg-blue-600 py-10 px-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="material-icons text-4xl text-white">business</span>
                        <h1 class="text-4xl font-bold ml-3 text-white">Detail Usaha</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-bold text-white">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-12 w-12 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <main class="p-10 mx-32 mt-6">
                <div
                    class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                    <span class="material-icons text-blue-500 text-4xl">business</span>
                    <h1>Detail Usaha</h1>
                </div>

                <hr class="border-2 border-gray-500 w-[600px] mx-auto mb-8">

                {{-- Kategori (readonly view) --}}
                <div class="mb-4 mt-10">
                    <label class="block mb-2 text-sm font-bold text-black">Kategori</label>
                    <div class="w-full rounded-lg p-3 text-sm border border-gray-500 bg-gray-100">
                        {{ $usaha->kategori->nama_kategori ?? '-' }}
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-6">
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black">NPWP</label>
                        <input type="text" value="{{ $usaha->npwp }}" readonly
                            class="w-full rounded-lg border p-3 text-sm bg-gray-100 border-gray-500">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black">Nama Usaha</label>
                        <input type="text" value="{{ $usaha->nama_usaha }}" readonly
                            class="w-full rounded-lg border p-3 text-sm bg-gray-100 border-gray-500">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black">Alamat Usaha</label>
                        <input type="text" value="{{ $usaha->alamat_usaha }}" readonly
                            class="w-full rounded-lg border p-3 text-sm bg-gray-100 border-gray-500">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black">Nama Pemilik</label>
                        <input type="text" value="{{ $usaha->nama_pemilik }}" readonly
                            class="w-full rounded-lg border p-3 text-sm bg-gray-100 border-gray-500">
                    </div>

                    <div class="mb-4 col-span-2">
                        <label class="block mb-2 text-sm font-bold text-black">Alamat Pemilik</label>
                        <input type="text" value="{{ $usaha->alamat_pemilik }}" readonly
                            class="w-full rounded-lg border p-3 text-sm bg-gray-100 border-gray-500">
                    </div>
                </div>

                <div class="flex space-x-4 mt-10">
                    <a href="{{ route('usahas.index') }}"
                        class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                        Kembali
                    </a>
                </div>
            </main>
        </div>
    </div>
@endsection

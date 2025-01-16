@extends('layouts.app')

@section('content')
    <div class="flex h-screen bg-gray-100"> <!-- Kontainer utama dengan latar belakang abu-abu -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        <!-- Konten Utama -->
        <main class="flex-1 bg-gray-200">

            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">folder_open</span>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-10">
                <div
                    class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                    <span class="material-icons text-blue-500 text-4xl">folder_open</span>
                    <h1>Detail Peminjaman</h1>
                </div>

                <hr class="border-2 border-gray-500 w-[600px] mx-auto">
                <div class="p-6">
                    <div class="mb-3">
                        <h2 class="text-2xl font-semibold mb-4">Informasi Peminjaman</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Nama Peminjam:</p>
                                <p>{{ $peminjaman->nama_peminjam }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Nama Arsip Yang Pipinjam:</p>
                                <p>{{ $peminjaman->arsip->nama_usaha }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Kategori:</p>
                                <p>{{ $peminjaman->arsip->kategori->nama_kategori }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Tahun Arsip:</p>
                                <p>{{ $peminjaman->arsip->tahun }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Bulan Arsip:</p>
                                <p>{{ $peminjaman->arsip->bulan }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Status:</p>
                                <p>{{ $peminjaman->status }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Tanggal Pinjam:</p>
                                <p>{{ $peminjaman->tgl_minjam }}</p>
                            </div>
                            <div class="p-4 rounded-lg border border-gray-500">
                                <p class="font-bold">Tanggal Kembali:</p>
                                <p>{{ $peminjaman->tgl_kembali }}</p>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold mb-4 ">Keperluan</h2>
                    <div class="p-4 rounded-lg border border-gray-500">
                        <p>{{ $peminjaman->keperluan }}</p>
                    </div>
                    <h2 class="text-2xl font-semibold mt-8 mb-4">File Arsip</h2>

                    <div class="flex gap-4">
                       
                        <div class="flex gap-6 justify-between">
                            @if ($peminjaman->file_path)
                                <div class="flex items-center space-x-4">
                                    <a href="{{ asset('storage/' . $peminjaman->file_path) }}" target="_blank"
                                        class="bg-gray-500 px-6 py-3 rounded-lg text-white font-semibold transform transition-transform duration-200 hover:scale-110">
                                        Lihat File
                                    </a>
                                </div>
                            @else
                                <p>Tidak ada file yang diunggah.</p>
                            @endif
                        </div>

                        <div class="flex items-center">
                            @if (auth()->user() && auth()->user()->role == 'admin')
                                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}">
                                    <button
                                        class="mr-6 bg-green-600 text-white py-3 px-6 font-semibold rounded-md hover:bg-green-700 transform transition-transform duration-200 hover:scale-110">
                                        Edit
                                    </button>
                                </a>
                                <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST"
                                    class="gap-6 flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 font-semibold transform transition-transform duration-200 hover:scale-110">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                            <a href="/peminjaman">
                                <button
                                    class="px-6 py-3 text-white font-bold bg-blue-500 rounded-lg hover:bg-blue-600 transform transition-transform duration-200 hover:scale-110">
                                    Kembali
                                </button>
                            </a>
                        </div>


                    </div>


                </div>
            </div>
        </main>
    </div>
@endsection

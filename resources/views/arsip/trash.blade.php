@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 bg-white">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">archive</span>
                    <h1 class="text-4xl font-bold ml-3 text-white">
                        Arsip Terhapus
                    </h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <main class="px-10 mt-16">
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4 relative">
                        {{ session('success') }}
                        <button onclick="this.parentElement.style.display='none'"
                            class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                            &times;
                        </button>
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('arsip.index') }}"
                        class="inline-block px-5 py-3 bg-gray-500 text-white font-bold rounded-lg shadow hover:bg-gray-600 transform transition-transform duration-300 hover:scale-110">
                        <i class="fa-solid fa-arrow-left mr-2 font-bold text-lg"></i>
                        Kembali ke Arsip
                    </a>
                </div>

                <div class="overflow-x-auto bg-white shadow-md border border-black">
                    <table class="min-w-full table-auto divide-y divide-gray-300">
                        <thead class="bg-blue-500">
                            <tr>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    No</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    NPWP</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Nama Usaha</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Alamat Usaha</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Nama Pemilik</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Tahun</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Bulan</th>
                                <th class="px-5 py-3 text-center text-xs font text-white font-bold border-black border-b">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($arsips as $index => $arsip)
                                <tr class="hover:bg-gray-100">
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $index + 1 }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->npwp ?? '-' }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->nama_usaha ?? '-' }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->alamat_usaha ?? '-' }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->nama_pemilik ?? '-' }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->tahun }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->bulan }}</td>
                                    <td class="border-black border-b text-center">
                                        <form action="{{ route('arsip.restore', $arsip->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin mengembalikan arsip ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button class="bg-green-500 hover:bg-green-600 px-1 py-1 mr-2 text-white rounded-lg">
                                                <i class="fa-solid fa-rotate-left"></i> Restore
                                            </button>
                                        </form>
                                        {{-- Tombol Hapus Permanen --}}
                                        <form action="{{ route('arsip.forceDelete', $arsip->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus arsip ini secara permanen? Data tidak bisa dikembalikan!')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 px-1 py-1 text-white rounded-lg">
                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-56 text-center text-xl text-gray-500 font-bold">Tidak
                                        ada arsip terhapus</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mb-12"></div>
            </main>
        </div>
    </div>
@endsection

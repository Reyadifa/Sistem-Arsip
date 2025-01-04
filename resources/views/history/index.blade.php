@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 bg-gray-100">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <i class="fas fa-book text-4xl text-white"></i>
                    <h1 class="text-4xl font-bold ml-3 text-white">History Peminjaman</h1>
                </div>
            </div>

            <main class="p-14">
                <div class="overflow-x-auto bg-white shadow-md rounded-xl border-r border-l border-t border-black">
                    <table class="min-w-full table-auto divide-y divide-gray-300">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Nama Peminjam</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Nama Arsip Yang Dipinjam</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Kategori</th>
                                <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Tahun Arsip Yang Dipinjam</th>
                                <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Bulan Arsip Yang Dipinjam</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Tanggal Minjam</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Tanggal Kembali</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Status</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($peminjamans as $peminjaman)
                                @if ($peminjaman->status == 'Dikembalikan') 
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">{{ $peminjaman->nama_peminjam }}</td>
                                        <td class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->nama_usaha }}</td>
                                        <td class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->kategori->nama_kategori }}</td>
                                        <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->tahun }}</td>
                                        <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->bulan }}</td>
                                        <td class="px-4 py-3 text-center text-xs text-black-500 border-r border-black border-b">{{ $peminjaman->tgl_minjam }}</td>
                                        <td class="px-4 py-3 text-center text-xs text-black-500 border-r border-black border-b">{{ $peminjaman->tgl_kembali }}</td>
                                        <td class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">{{ $peminjaman->status }}</td>
                                        <td class="border-black border-b">
                                            <div class="flex items-center px-2 py-3 justify-center space-x-2">
                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-lg">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>                                        
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-72 text-center text-xs text-gray-500 font-bold">Tidak ada history untuk saat ini</td>
                                </tr>
                            @endforelse
                        </tbody>                        
                    </table>
                </div>

                {{ $peminjamans->links('vendor.pagination.tailwind') }}
            </main>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 bg-white">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <i class="fas fa-book text-4xl text-white"></i>
                    <h1 class="text-4xl font-bold ml-3 text-white">History Peminjaman</h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center"><i
                                class="fas fa-user text-4xl text-white "></i></div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-6 mx-auto mt-10 max-w-8xl px-14">
                <!-- Form Cari -->
                <form action="{{ route('history.index') }}" method="GET" class="flex-grow relative">
                    <label for="history" class="sr-only">Cari</label>
                    <input id="history" type="text" name="search" value="{{ request('search') }}" placeholder="Cari"
                        class="border-2 border-black rounded-lg py-2 pl-3 pr-10 text-sm w-full" />
                    <button type="submit" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <!-- Export PDF (form terpisah) -->
                <form action="{{ route('history.exportPdf') }}" method="GET" class="inline">
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                </form>

                <!-- Reset -->
                <a href="{{ route('history.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg cursor-pointer whitespace-nowrap">
                    Reset
                </a>
            </div>

            <main class="p-5 ml-10 mr-10">
                <div class="overflow-x-auto bg-white shadow-md border border-l  border-black">
                    <table class="min-w-full table-auto divide-y divide-gray-300">
                        <thead class="bg-blue-500">
                            <tr>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    No</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                    Nama Peminjam</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                    Nama Arsip Yang Dipinjam</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                    Kategori</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Tahun Arsip Yang Dipinjam</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    Bulan Arsip Yang Dipinjam</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                    Tanggal Minjam</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                    Tanggal Kembali</th>
                                <th
                                    class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                    Status</th>
                                @if (auth()->user() && auth()->user()->role == '1')
                                    <th
                                        class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">
                                        Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($peminjamans as $peminjaman)
                                @if ($peminjaman->status == 'Dikembalikan')
                                    <tr class="hover:bg-gray-100">
                                        <td
                                            class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                            {{ $peminjamans->firstItem() + $loop->index }}
                                        </td>
                                        <td
                                            class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->nama_peminjam }}</td>
                                        <td
                                            class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->arsip->nama_usaha }}</td>
                                        <td
                                            class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->arsip->kategori->nama_kategori }}</td>
                                        <td
                                            class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->arsip->tahun }}</td>
                                        <td
                                            class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->arsip->bulan }}</td>
                                        <td
                                            class="px-4 py-3 text-center text-xs text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->tgl_minjam }}</td>
                                        <td
                                            class="px-4 py-3 text-center text-xs text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->tgl_kembali }}</td>
                                        <td
                                            class="px-4 py-3 text-left text-xs text-black-500 border-r border-black border-b">
                                            {{ $peminjaman->status }}</td>
                                        @if (auth()->user() && auth()->user()->role == '1')
                                            <td class="border-black border-b">
                                                <div class="flex items-center px-2 py-3 justify-center space-x-2">
                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}"
                                                        method="POST" style="display: inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-lg">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-60 text-center text-gray-500 text-2xl font-bold">Tidak
                                        ada data history</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $peminjamans->links('vendor.pagination.tailwind') }}
            </main>
        </div>
    </div>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    {{-- Js --}}
    <script src="{{ asset('js/histori.js') }}"></script>
@endsection

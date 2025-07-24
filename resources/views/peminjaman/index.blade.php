@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 bg-white">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <i class="fas fa-book text-4xl text-white"></i>
                    <h1 class="text-4xl font-bold ml-3 text-white">Peminjaman</h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <main class="p-14">
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4 relative">
                        {{ session('success') }}
                        <button onclick="this.parentElement.style.display='none'"
                            class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                            &times;
                        </button>
                    </div>
                @endif

                @if (session('success_delete'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4 relative">
                        {{ session('success_delete') }}
                        <button onclick="this.parentElement.style.display='none'"
                            class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                            &times;
                        </button>
                    </div>
                @endif

                @if (auth()->user() && in_array(auth()->user()->role, ['1', '2']))
                    <div class="mt-4">
                        <a href="{{ route('peminjaman.create') }}"
                            class="mb-6 inline-block px-5 py-3 bg-green-500 text-white font-bold rounded-lg shadow hover:bg-green-600 transform transition-transform duration-300 hover:scale-110 ">
                            <i class="fa-solid fa-plus mr-2 font-bold text-lg"></i>
                            <span>Tambah Peminjaman</span>
                        </a>
                    </div>
                @endif

                <form action="{{ route('peminjaman.index') }}" method="GET" class="flex items-center">
                    <div class="flex flex-col relative mr-10 w-full">
                        <label for="peminjaman" class="pl-1">Cari</label>
                        <input id="peminjaman" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari" class="border-2 rounded-lg mb-8 border-black py-[9px] text-sm pl-2 w-full">
                        <button type="submit" class="absolute top-8 right-3 text-gray-500">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                    <div class="mt-[26px]">
                        <div
                            class="bg-gray-500 px-6 py-1 mb-8 rounded-lg text-white font-semibold h-9 hover:bg-gray-600 cursor-pointer">
                            <a href="{{ route('peminjaman.index') }}">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto bg-white shadow-md border border-black">
                    <table class="min-w-full table-auto divide-y divide-gray-300">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">No</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Nama
                                    Peminjam</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">No HP
                                </th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Nama
                                    Usaha</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Tahun
                                </th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Bulan
                                </th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">File
                                    Arsip</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Surat
                                    Kuasa</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Tgl
                                    Pinjam</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Tgl
                                    Kembali</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black">Status
                                </th>
                                @if (auth()->user() && in_array(auth()->user()->role, ['1', '2']))
                                    <th class="px-5 py-3 text-center text-xs font-bold text-white">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($peminjamans as $peminjaman)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjamans->firstItem() + $loop->index }}</td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjaman->nama_peminjam }}</td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">{{ $peminjaman->nohp }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjaman->arsip->usaha->nama_usaha ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjaman->arsip->tahun ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjaman->arsip->bulan ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        @if ($peminjaman->file_arsip)
                                            <a href="{{ asset('storage/' . $peminjaman->file_arsip) }}" target="_blank"
                                                class="flex justify-center">
                                                <i
                                                    class="fas fa-file px-4 py-[5px] text-xl text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg"></i>
                                            </a>
                                        @else
                                            <span class="text-gray-500 text-xs">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        @if ($peminjaman->surat_kuasa)
                                            <a href="{{ asset('storage/' . $peminjaman->surat_kuasa) }}" target="_blank"
                                                class="flex justify-center">
                                                <i
                                                    class="fas fa-file-pdf px-4 py-[5px] text-xl text-white bg-red-500 hover:bg-red-600 rounded-lg"></i>
                                            </a>
                                        @else
                                            <span class="text-gray-500 text-xs">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjaman->tgl_minjam }}</td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        {{ $peminjaman->tgl_kembali }}</td>
                                    <td class="px-4 py-3 text-center text-xs border-r border-black">
                                        @php
                                            $statusClass = match ($peminjaman->status) {
                                                'Dipinjam' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                                'Dikembalikan' => 'bg-green-100 text-green-800 border-green-300',
                                                'Terlambat' => 'bg-red-100 text-red-800 border-red-300',
                                                default => 'bg-gray-100 text-gray-800 border-gray-300',
                                            };
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                            {{ $peminjaman->status }}
                                        </span>
                                    </td>
                                    @if (auth()->user() && in_array(auth()->user()->role, ['1', '2']))
                                        <td class="border-black">
                                            <div class="flex items-center justify-center space-x-2 px-2 py-3">
                                                <!-- Tombol Kembalikan -->
                                                <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengembalikan arsip ini?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>

                                                <form id="delete-form-{{ $peminjaman->id }}"
                                                    action="{{ route('peminjaman.destroy', $peminjaman->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete({{ $peminjaman->id }})"
                                                        class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-lg">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="px-4 py-60 text-center text-xl text-gray-500 font-bold">
                                        Tidak ada peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $peminjamans->links('vendor.pagination.tailwind') }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('js/arsip.js') }}"></script>
@endsection

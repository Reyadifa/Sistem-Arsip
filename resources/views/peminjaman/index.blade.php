@extends('layouts.app')

@section('content')
    <div class="flex ">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1  bg-gray-100 ">
           
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <i class="fas fa-book text-4xl text-white "></i>  
                    <h1 class="text-4xl font-bold ml-3 text-white">
                        Peminjaman
                    </h1>
                    </h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center"><i class="fas fa-user text-4xl text-white "></i></div>
                    </div>                    
                </div>
            </div> 
            <main class="p-14">        
            
            <!-- Pesan Sukses atau Error -->
            @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4 relative">
                {{ session('success') }}
                <!-- Icon X untuk menutup notifikasi -->
                <button onclick="this.parentElement.style.display='none'" 
                        class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                    &times;
                </button>
            </div>
            @endif

            <!-- Pesan Sukses atau Error -->
            @if (session('success_delete'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4 relative">
                {{ session('success_delete') }}
                <!-- Icon X untuk menutup notifikasi -->
                <button onclick="this.parentElement.style.display='none'" 
                        class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                    &times;
                </button>
            </div>
            @endif

            <!-- Tombol Tambah Peminjaman -->
            <div class="mt-20">
            <a href="{{ route('peminjaman.create') }}"
                class="mb-6 inline-block px-5 py-3 bg-green-500 text-white font-bold rounded-lg shadow hover:bg-green-600 transform transition-transform duration-300 hover:scale-110 ">
                <i class="fa-solid fa-plus mr-2 font-bold text-lg"></i>
                <span>Tambah Peminjaman</span>
            </a>
        </div>

            {{-- Kotak Border --}}
            <div class="overflow-x-auto bg-white shadow-md rounded-xl border-r border-l border-t border-black">
                <table class="min-w-full table-auto divide-y divide-gray-300">
                    <thead class="bg-blue-500">
                        <tr>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Nama Peminjam</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Nama Arsip Yang Dipinjam</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">kategori</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Tahun Arsip Yang Dipinjam</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Bulan Arsip Yang Dipinjam</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b ">File</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Taanggal Minjam</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Taanggal Kembali</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">Status</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-black border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($peminjamans as $index => $peminjaman)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->nama_peminjam }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->nama_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">
                                    {{ $peminjaman->arsip->kategori->nama_kategori }}
                                </td>                                
                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->tahun }}</td>
                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->arsip->bulan }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">
                                    @if ($peminjaman->arsip && $peminjaman->arsip->file_path)
                                    {{-- edit --}}
                                        <a href="{{ asset('storage/' . $peminjaman->arsip->file_path) }}" target="_blank" class=" mx-auto flex justify-center">
                                            <i class="fas fa-file px-4 py-[5px] text-xl text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg"></i> 
                                        </a>
                                    @endif

                                </td>

                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->tgl_minjam }}</td>
                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->tgl_kembali }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $peminjaman->status }}</td>
                                <td class="border-black border-b">
                                    <div class="flex items-center px-2 py-3 justify-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('peminjaman.edit', $peminjaman->id) }}"
                                            class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $peminjaman->id }}"
                                            action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-lg"
                                                onclick="confirmDelete({{ $peminjaman->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-60 text-center text-xl text-gray-500 font-bold">Tidak ada peminjaman untuk saat ini</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $peminjamans->links('vendor.pagination.tailwind') }}
        </main>
        </div>
    </div>
    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    {{-- js --}}
    <script src="{{ asset('js/arsip.js') }}"></script>
@endsection
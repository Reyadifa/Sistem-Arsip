@extends('layouts.app')

@section('content')
    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 bg-white">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">archive</span>
                    <h1 class="text-4xl font-bold ml-3 text-white">
                        Arsip
                    </h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center"><i
                                class="fas fa-user text-4xl text-white "></i></div>
                    </div>
                </div>
            </div>

            <main class="px-10 mt-16">
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

                <!-- Tombol Tambah Arsip -->
                @if (auth()->user() && in_array(auth()->user()->role, [1, 3]))
                    <a href="{{ route('arsip.create') }}"
                        class="mb-6 inline-block px-5 py-3 bg-green-500 text-white font-bold rounded-lg shadow hover:bg-green-600 transform transition-transform duration-300 hover:scale-110">
                        <i class="fa-solid fa-plus mr-2 font-bold text-lg "></i>
                        <span class="">Tambah Arsip</span></a>
                @endif

                <form class="flex justify-between py-6" method="GET" action="{{ route('arsip.index') }}">
                    {{-- cari Npwp --}}
                    <div class="flex flex-col relative mr-5 w-full">
                        <label for="npwp" class="pl-1">Cari</label>
                        <input id="npwp" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari" class="border-2 rounded-lg mb-8 border-black py-[9px] text-sm pl-2 w-full">
                        <button type="submit" class="absolute top-8 right-3 text-gray-500">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                    {{-- Reset --}}
                    <div class="mt-[26px]">
                        <div
                            class="bg-gray-500 px-6 py-1  rounded-lg text-white font-semibold h-9 hover:bg-gray-600 cursor-pointer  ">
                            <a href="{{ route('arsip.index') }}">Reset</a>
                        </div>
                    </div>
                </form>


                {{-- Kotak Border --}}
                <div class="overflow-x-auto bg-white shadow-md border border-black ">

                    <table class="min-w-full table-auto divide-y divide-gray-300  ">
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
                                    Kategori</th>
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
                                <th
                                    class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">
                                    File</th>
                                <th class="px-5 py-3 text-center text-xs font text-white font-bold border-black border-b">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <!-- bagian tbody dalam table -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($arsips as $index => $arsip)
                                <tr class="hover:bg-gray-100">
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsips->firstItem() + $index }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->npwp ?? '-' }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->nama_usaha ?? '-' }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->alamat_usaha ?? '-' }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->usaha->nama_pemilik ?? '-' }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->tahun }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $arsip->bulan }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font justify-items-center text-black-500 border-r border-black border-b">
                                        @if ($arsip->file_path)
                                            <div
                                                class="bg-yellow-500 border hover:bg-yellow-600 w-12 text-base py-2 rounded-lg font-bold flex items-center justify-center cursor-pointer">
                                                <a href="{{ asset('storage/' . $arsip->file_path) }}"
                                                    class="text-white hover:underline" target="_blank">
                                                    <i class="fa-solid fa-file"></i>
                                                </a>
                                            </div>
                                        @else
                                            <span class="text-gray-500 border">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="border-black border-b">
                                        <div class="flex items-center px-2 py-3 justify-center space-x-2">
                                            <a href="{{ route('arsip.show', $arsip->id) }}"
                                                class="px-4 py-2 text-white bg-gray-500 hover:bg-gray-600 rounded-lg">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @if (auth()->user() && in_array(auth()->user()->role, [1, 3]))
                                                <a href="{{ route('arsip.edit', $arsip->id) }}"
                                                    class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <form id="delete-form-{{ $arsip->id }}"
                                                    action="{{ route('arsip.destroy', $arsip->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-lg"
                                                        onclick="confirmDelete({{ $arsip->id }})">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-4 py-56 text-center text-xl text-gray-500 font-bold">Tidak
                                        ada arsip</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                {{ $arsips->links('vendor.pagination.tailwind') }}
                <div class="mb-12"></div>
        </div>
        </main>
    </div>
    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    {{-- js --}}
    <script src="{{ asset('js/arsip.js') }}"></script>
@endsection

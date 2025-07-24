@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 bg-white">
            <!-- Header -->
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">business</span>
                    <h1 class="text-4xl font-bold ml-3 text-white">Usaha</h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white">{{ Auth::user()->nama_user ?? 'User' }} |</h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <main class="px-10 mt-16">
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4 relative">
                        {{ session('success') }}
                        <button onclick="this.parentElement.style.display='none'" class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                            &times;
                        </button>
                    </div>
                @endif

                <!-- Tombol & Form Search -->
                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('usahas.create') }}"
                        class="px-5 py-3 bg-green-500 text-white font-bold rounded-lg shadow hover:bg-green-600 transform transition-transform duration-300 hover:scale-110">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Usaha
                    </a>
                    <form method="GET" class="flex gap-2 items-end">
                        <div>
                            <label class="block mb-1 text-sm">Cari</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Nama usaha / pemilik / NPWP"
                                class="border border-black rounded-lg px-3 py-2 text-sm w-64">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <a href="{{ route('usahas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Reset
                        </a>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto bg-white shadow-md border border-black">
                    <table class="min-w-full table-auto divide-y divide-gray-300">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">No</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Kategori</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">NPWP</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Nama Usaha</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Alamat Usaha</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Nama Pemilik</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-r border-black border-b">Alamat Pemilik</th>
                                <th class="px-5 py-3 text-center text-xs font-bold text-white border-black border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $search = request('search');
                                $filteredUsahas = $search
                                    ? $usahas->filter(function ($u) use ($search) {
                                        return str_contains(strtolower($u->nama_usaha), strtolower($search)) ||
                                               str_contains(strtolower($u->nama_pemilik), strtolower($search)) ||
                                               str_contains(strtolower($u->npwp), strtolower($search));
                                    })
                                    : $usahas;
                            @endphp

                            @forelse ($filteredUsahas as $index => $usaha)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3 text-center text-xs text-black border-r border-black border-b">{{ $index + 1 }}</td>
                                    <td
                                        class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                        {{ $usaha->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-xs text-black border-r border-black border-b">{{ $usaha->npwp }}</td>
                                    <td class="px-4 py-3 text-center text-xs text-black border-r border-black border-b">{{ $usaha->nama_usaha }}</td>
                                    <td class="px-4 py-3 text-center text-xs text-black border-r border-black border-b">{{ $usaha->alamat_usaha }}</td>
                                    <td class="px-4 py-3 text-center text-xs text-black border-r border-black border-b">{{ $usaha->nama_pemilik }}</td>
                                    <td class="px-4 py-3 text-center text-xs text-black border-r border-black border-b">{{ $usaha->alamat_pemilik }}</td>
                                    <td class="border-black border-b">
                                        <div class="flex items-center justify-center space-x-2 px-2 py-2">
                                            <a href="{{ route('usahas.show', $usaha->id) }}"
                                                class="px-4 py-2 text-white bg-gray-500 hover:bg-gray-600 rounded-lg">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('usahas.edit', $usaha->id) }}"
                                                class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('usahas.destroy', $usaha->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus usaha ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-lg">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-56 text-center text-xl text-gray-500 font-bold">Data tidak ditemukan.</td>
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

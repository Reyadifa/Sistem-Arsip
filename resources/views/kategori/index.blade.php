@extends('layouts.app')

@section('content')
    <div class="flex "> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')
        <div class="flex-1  bg-white">

            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-white text-4xl">category</span> 
                    <h1 class="text-4xl font-bold ml-3 text-white">
                        Kategori
                    </h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center"><i class="fas fa-user text-4xl text-white "></i></div>
                    </div>                    
                </div>
            </div>

            <main class="flex-grow p-8 bg-white">
                <div class="max-w-10xl mx-auto  rounded-lg p-8">
                   
                    

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

                    <div class="mb-6">
                        <a href="{{ route('kategori.create') }}"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg mb-4 inline-block transform transition-transform duration-300 hover:scale-110">
                            <i class="fa-solid fa-plus mr-2 font-bold text-lg"></i> Tambah Kategori
                        </a>

                        <div class="flex flex-col space-y-4">
                            <form action="{{ route('kategori.index') }}" method="GET" class="flex items-center space-x-4 justify-end">
                                <div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari Kategori"
                                        class="border-2 rounded-lg border-gray-400 py-[9px] text-sm pl-4"
                                        style="width: 1490px;">
                                </div>
                                <button type="submit"
                                    class="bg-blue-600 py-1 px-3 h-9 rounded-lg text-white font-semibold  hover:bg-blue-800 cursor-pointer ml-auto">
                                    <span class="mr-2">Cari</span>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <div
                                    class="bg-gray-500 px-3 py-1 t-1 rounded-lg text-white font-semibold h-9 hover:bg-gray-600 cursor-pointer ml-auto">
                                    <a href="{{ route('kategori.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Kotak  --}}
                    <div class="overflow-hidden bg-white shadow-md border">
                        <table class="min-w-full divide-y divide-gray-200 border border-black">
                            <thead class="bg-blue-500 text-black font-bold border border-black">
                                <tr class="">
                                    <th
                                        class="px-2 py-2 text-center w-24 border border-black text-xs uppercase text-white font-extrabold tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-center border border-black text-xs uppercase text-white font-extrabold tracking-wider">
                                        <span class="font-bold"> Nama
                                            Kategori</span></th>
                                    <th
                                        class="px-6 py-3 text-center border border-black text-xs uppercase text-white font-extrabold tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($kategoris as $index => $kategori)
                                    <tr>
                                        <td class="px-2 py-2 border border-black text-center text-xs font text-black-500">
                                            {{ $kategoris->firstItem() + $index }} <!-- Perbaikan penggunaan $index -->
                                        </td>
                                        <td
                                            class="px-6 py-4 border border-black text-center whitespace-nowrap text-sm text-gray-900">
                                            {{ $kategori->nama_kategori }}</td>
                                        <td class="px-6 py-4 border border-black whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-4 justify-center">
                                                {{-- edit --}}
                                                <a href="{{ route('kategori.edit', $kategori->id_kategori) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold  rounded-lg transition py-2 px-4"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                {{-- js nya di sini --}}
                                                <form id="delete-form-{{ $kategori->id_kategori }}"
                                                    action="{{ route('kategori.destroy', $kategori->id_kategori) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    {{-- hapus --}}
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg"
                                                        onclick="confirmDelete({{ $kategori->id_kategori }})">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-60 text-center text-xl text-gray-500 font-bold">Tidak ada kategori untuk saat ini</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $kategoris->links() }}
                    </div>
                </div>
            </main>




        </div>
    </div>



    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- js kategori --}}
    <script src="{{ asset('js/kategori.js') }}"></script>
@endsection

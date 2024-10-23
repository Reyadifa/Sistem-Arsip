@extends('layouts.app')

@section('content')


 <div class="flex "> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')
        <div class="flex-1  bg-gray-100 "> 



  <main class="flex-grow p-8 bg-gray-100">
            <div class="max-w-10xl mx-auto bg-white shadow-xl rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Kategori</h1>

                <!-- Pesan Sukses atau Error -->

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('kategori.create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition mb-4 inline-block">
                        <i class="fa-solid fa-plus mr-2 font-bold text-lg"></i> Tambah Kategori
                    </a>
                
                    <div class="flex flex-col space-y-4">
                        <form action="{{ route('kategori.index') }}" method="GET" class="flex items-center space-x-4">
                            <div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kategori"
                                    class="border-2 rounded-lg border-gray-400 py-[9px] text-sm pl-4" style="width: 950px;">
                            </div>
                            <button type="submit" class="bg-blue-600 py-1 px-3 h-9 rounded-lg text-white font-semibold  hover:bg-blue-800 cursor-pointer">
                                <span class="mr-2">Cari</span> 
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <div class="bg-gray-500 px-3 py-1 t-1 rounded-lg text-white font-semibold h-9 hover:bg-gray-600 cursor-pointer">
                                <a href="{{ route('kategori.index') }}">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>                

                <div class="overflow-hidden bg-white shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 border-2 ">
                        <thead class="bg-gray-200 text-black font-bold">
                            <tr class="">
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider"><span class="font-bold"> Nama
                                    Kategori</span></th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kategoris as $index =>  $kategori)
                                <tr>
                                    <td class="px-4 py-3 text-center text-xs font text-black-500">
                                        {{ $kategoris->firstItem() + $index }} <!-- Perbaikan penggunaan $index -->
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-900">
                                        {{ $kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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
                            @endforeach
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
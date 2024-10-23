@extends('layouts.app')

@section('content')
  

    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10 bg-gray-100 ">

            
            <h2 class="text-5xl font-[Modak] font-black text-blue-500 text-center h-20"
                  style="-webkit-text-stroke: 2px black;">Sistem Informasi Manajemen Arsip</h2>                            
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Data Arsip</h1>

            <!-- Tombol Tambah Arsip -->
            <a href="{{ route('arsip.create') }}"
                class="mb-6 inline-block px-5 py-3 bg-green-500 text-white font-bold rounded-lg shadow hover:bg-green-600">
                <i class="fa-solid fa-plus mr-2 font-bold text-lg"></i>
                <span class="">Tambah Arsip</span></a>

            <form class="flex justify-between " method="GET" action="{{ route('arsip.index') }}">
                {{-- cari Npwp --}}
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NPWP"
                        class=" border-2 rounded-lg mb-8 border-gray-400 py-[9px] text-sm pl-4 w-80">
                </div>
                {{-- Cari Bulan --}}
                <div class="">
                    <label for="bulan" class="">Bulan:</label>
                    <select name="bulan" id="bulan" class="border-2 border-gray-400 rounded-lg pl-4  py-2 w-80">
                        <option value="" disabled selected  class="text-gray-500">Pilih Bulan</option>
                        <option value="Januari" {{ request('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ request('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ request('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ request('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ request('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ request('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ request('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September
                        </option>
                        <option value="Oktober" {{ request('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ request('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>

                {{-- Cari Tahun --}}
                <div>
                    <label for="tahun">Tahun:</label>
                    <input class="border-gray-400 border-2 rounded-lg px-4 py-2 max-w-80" type="text" name="tahun"
                        id="tahun" value="{{ request('tahun') }}" placeholder="Ketik Tahun" maxlength="4"
                        title="Masukkan angka tahun" pattern="\d*" />
                    <button type="submit" class="bg-blue-600 px-3 h-9 rounded-lg text-white font-semibold ml-5 hover:bg-blue-800 cursor-pointer"><span
                            class="mr-2">Cari</span> <i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                {{-- Reset --}}
                <div class="bg-gray-500 px-6 py-1 mt-1 rounded-lg text-white font-semibold h-9 hover:bg-gray-600 cursor-pointer">
                    <a href="{{ route('arsip.index') }}">Reset</a>
                </div>
            </form>


            {{-- Kotak Border --}}
            
            <div class="overflow-x-auto bg-white shadow-md rounded-xl border-r border-l border-t border-black mt-16">

                <table class="min-w-full table-auto divide-y divide-gray-300  ">
                    <thead class="bg-blue-500">
                        <tr>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-r border-black border-b">No</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">NPWP</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Kategori</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Nama Usaha</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Alamat Usaha</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Nama Pemilik</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Alamat Pemilik</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Tahun</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">Bulan</th>
                            <th class="px-5 py-3 text-left text-xs font text-white font-bold border-r border-black border-b">File</th>
                            <th class="px-5 py-3 text-center text-xs font text-white font-bold border-black border-b">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($arsips as $index => $arsip)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">
                                    {{ $arsips->firstItem() + $index }} <!-- Perbaikan penggunaan $index -->
                                </td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $arsip->npwp }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">
                                    {{ $arsip->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $arsip->nama_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $arsip->alamat_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $arsip->nama_pemilik }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">{{ $arsip->alamat_pemilik }}
                                </td>
                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $arsip->tahun }}</td>
                                <td class="px-4 py-3 text-center text-xs font text-black-500 border-r border-black border-b">{{ $arsip->bulan }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500 border-r border-black border-b">
                                    @if ($arsip->file_path)
                                        {{-- Tombol file --}}
                                        <div
                                            class="bg-yellow-500 border hover:bg-yellow-600 w-12 text-base py-2 rounded-lg font-bold  flex items-center justify-center cursor-pointer">
                                            <a href="{{ asset('storage/' . $arsip->file_path) }}"
                                                class="text-white hover:underline" target="_blank"><i
                                                    class="fa-solid fa-file"></i></a>
                                        </div>
                                    @else
                                        <span class="text-gray-500 border">Tidak ada file</span>
                                    @endif
                                </td>

                                <td class="border-black border-b">
                                    <div class="flex items-center px-2   py-3 justify-center space-x-2 ">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('arsip.show', $arsip->id) }}"
                                            class="px-4 py-2 text-white  bg-gray-500 hover:bg-gray-600 rounded-lg"><i
                                                class="fa-solid fa-eye"></i></a>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('arsip.edit', $arsip->id) }}"
                                            class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        <!-- Tombol Hapus -->
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

                                    </div>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <!-- Pagination -->
            {{ $arsips->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    {{-- js --}}
    <script src="{{ asset('js/arsip.js') }}"></script>
@endsection
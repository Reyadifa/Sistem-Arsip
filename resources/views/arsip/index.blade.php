@extends('layouts.app')

@section('content')
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
<div class="flex ">

    <!--include Sidebar -->
    @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10 bg-gray-100">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Data Arsip</h1>

            <!-- Tombol Tambah Arsip -->
            <a href="{{ route('arsip.create') }}" class="mb-6 inline-block px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">Tambah Arsip</a>

            <form method="GET" action="{{ route('arsip.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NPWP">               
            
                <label for="bulan">Bulan:</label>
                    <select name="bulan" id="bulan">
                        <option value="">Pilih Bulan</option>
                        <option value="Januari" {{ request('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ request('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ request('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ request('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ request('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ request('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ request('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September</option>
                        <option value="Oktober" {{ request('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ request('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>

            
                <label for="tahun">Tahun:</label>
                <input type="text" name="tahun" id="tahun" value="{{ request('tahun') }}" placeholder="Ketik Tahun" maxlength="4" title="Masukkan angka tahun" pattern="\d*" />

            
                <button type="submit">Cari</button>
                <a href="{{ route('arsip.index') }}">Reset</a>
            </form>            
                                              

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto divide-y divide-gray-300">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">NPWP</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Kategori</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Nama Usaha</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Alamat Usaha</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Nama Pemilik</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Alamat Pemilik</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Tahun</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Bulan</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">File</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($arsips as $arsip)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->npwp }}</td>
                            <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->nama_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->alamat_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->nama_pemilik }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->alamat_pemilik }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->tahun }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->bulan }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">
                                    @if($arsip->file_path)
                                        <a href="{{ asset('storage/' . $arsip->file_path) }}" class="text-blue-600 hover:underline" target="_blank">Lihat File</a>
                                    @else
                                        <span class="text-gray-500">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('arsip.show', $arsip->id) }}" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg">Detail</a>
                                    
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('arsip.edit', $arsip->id) }}" class="px-4 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg">Edit</a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg">Hapus</button>
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $arsips->links('pagination::tailwind') }}
                </div>
            </div>
    </div>

    @endsection    

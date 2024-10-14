@extends('layouts.app')

@section('content')
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
<div class="flex ">
    <!-- Sidebar -->
    <aside class=" bg-gradient-to-b from-blue-500 to-blue-700 text-white p-6">
        <h2 class="text-2xl font-bold mb-8">Manajemen Arsip</h2>
        <hr>
        <nav>
            <ul class="space-y-4">
                <li>
                    <a href="/arsip" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                        <span class="material-icons">archive</span>
                        <span class="ml-2">Arsip</span>
                    </a>
                </li>
                <li>
                    <a href="/kategori" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                        <span class="material-icons">category</span>
                        <span class="ml-2">Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="/users" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                        <span class="material-icons">person</span>
                        <span class="ml-2">User</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

        <!-- Main Content -->
        <div class="flex-1 p-10 bg-gray-100">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Data Arsip</h1>

            <!-- Tombol Tambah Arsip -->
            <a href="{{ route('arsip.create') }}" class="mb-6 inline-block px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">Tambah Arsip</a>

            <form action="{{ route('arsip.index') }}" method="GET" class="mb-4">
                <div class="relative">
                    <input 
                        type="search" 
                        name="search" 
                        placeholder="Search..." 
                        value="{{ request('search') }}" 
                        class="w-full py-3 pl-10 pr-4 border rounded-md text-gray-600 bg-white shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button 
                        type="submit" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Cari
                    </button>
                </div>
            </form>            

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto divide-y divide-gray-300">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">NPWP</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Kategori</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Nama Usaha</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Alamat Usaha</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Nama Pemilik</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Tahun</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Bulan</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">File</th>
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

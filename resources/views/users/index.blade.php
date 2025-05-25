@extends('layouts.app')

@section('content')
    <div class="flex "> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        {{-- Konten navbar --}}
        <div class="flex-1">
            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <i class="fas fa-user text-4xl text-white "></i>
                    <h1 class="text-4xl font-bold ml-3 text-white">
                        Daftar User
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

            <section class="py-4 flex-grow"> <!-- Penambahan padding untuk section -->
                <div class="max-w-10xl rounded-lg p-10">
                    <div class="rounded-lg overflow-hidden">
                        <div class="p-6">
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

                            {{-- Tambah User --}}
                            <div class="flex justify-between items-center mb-4">
                                <a href="{{ route('users.create') }}"
                                    class="bg-green-500 text-white px-4 py-3 rounded-md hover:bg-green-600 font-bold  transform transition-transform duration-300 hover:scale-110"><i
                                        class="fa-solid fa-plus mr-2 font-bold text-lg"></i> Tambah User</a>
                            </div>

                            <div class="flex flex-col">
                                <form action="{{ route('users.index') }}" method="GET"
                                    class="flex items-center p-4 space-x-4">
                                    <!-- Input Pencarian -->
                                    <div class="flex flex-col relative -ml-4 mr-2 w-full">
                                        <label for="users" class="pl-1">Cari</label>
                                        <input id="users" type="text" name="search" value="{{ request('search') }}"
                                            placeholder="Cari"
                                            class="border-2 rounded-lg border-black py-[9px] text-sm pl-2 w-full">
                                        <button type="submit" class="absolute top-8 right-3 text-gray-500">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                    <!-- Tombol Reset -->
                                    <a href="{{ route('users.index') }}"
                                        class="bg-gray-500 h-9 px-6 rounded-lg text-white font-semibold mt-6 hover:bg-gray-600 flex items-center justify-center">
                                        Reset
                                    </a>
                                </form>
                            </div>
                        </div>

                        {{-- Kotak Border --}}
                        <main class="px-6 ">
                            <div class="overflow-hidden border mb-10">
                                <table class="min-w-full">
                                    <thead class="bg-blue-500 text-white font-bold">
                                        <tr>
                                            <th class="py-3 px-4 w-24 border border-gray-500 text-center">No</th>
                                            <th class="py-3 px-4 w-96 border border-gray-500 text-center">NIP</th>
                                            <th class="py-3 px-4 border border-gray-500 text-center">Nama User</th>
                                            <th class="py-3 px-4 border border-gray-500 text-center">Role</th>
                                            <th class="py-3 px-4 border border-gray-500 w-96 p-24">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr class="hover:bg-gray-100 transition duration-300">
                                                <!-- Nomor urut -->
                                                <td class="py-2 px-4 border border-gray-500 text-center">
                                                    {{ $index + 1 }}
                                                </td>
                                                <!-- NIP -->
                                                <td class="py-2 px-4 border border-gray-500 text-center">
                                                    {{ $user->NIP }}
                                                </td>
                                                <!-- Nama User -->
                                                <td class="py-2 px-4 border border-gray-500 text-center">
                                                    {{ $user->nama_user }}
                                                </td>
                                                <!-- Role dengan badge -->
                                                <td class="py-2 px-4 border border-gray-500 text-center">
                                                    @if ($user->role == 1)
                                                        <span
                                                            class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">Pendataan</span>
                                                    @elseif($user->role == 2)
                                                        <span
                                                            class="bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">Pelayanan</span>
                                                    @elseif($user->role == 3)
                                                        <span
                                                            class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold">Pengarsipan</span>
                                                    @else
                                                        <span
                                                            class="bg-gray-500 text-white px-2 py-1 rounded text-xs font-semibold">Unknown</span>
                                                    @endif
                                                </td>
                                                <!-- Aksi -->
                                                <td class="py-2 px-4 border border-gray-500">
                                                    <div class="flex justify-center gap-5 w-96">
                                                        <a href="{{ route('users.edit', $user->NIP) }}"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 rounded-xl py-2 px-8 font-semibold">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $user->NIP }}"
                                                            action="{{ route('users.destroy', $user->NIP) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="text-white bg-red-500 hover:bg-red-700 rounded-xl py-2 px-8 font-semibold"
                                                                onclick="confirmDelete({{ $user->NIP }})">
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
                        </main>
                    </div>
                    <div class="p-4">
                        @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $users->links() }}
                        @endif
                        <!-- Menambahkan pagination -->
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    {{-- js arsip --}}
    <script src="{{ asset('js/user.js') }}"></script>
@endsection

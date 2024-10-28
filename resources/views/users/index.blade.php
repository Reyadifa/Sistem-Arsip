@extends('layouts.app')

@section('content')
    <div class="flex "> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')
        <div class="flex-1 p-10 bg-gray-100 ">

            <section class="py-4 flex-grow"> <!-- Penambahan padding untuk section -->
                <div class="max-w-10xl rounded-lg p-8">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-6">Daftar User</h2>
                            {{-- Tambah User --}}
                            <div class="flex justify-between items-center mb-4">
                                <a href="{{ route('users.create') }}"
                                    class="bg-green-500 text-white px-4 py-3 rounded-md hover:bg-green-600 font-bold transition duration-300 transform transition-transform duration-300 hover:scale-110"><i
                                        class="fa-solid fa-plus mr-2 font-bold text-lg"></i> Tambah User</a>
                            </div>

                            <div class="flex flex-col space-y-4">
                                <form action="{{ route('users.index') }}" method="GET"
                                    class="flex items-center space-x-4">
                                    {{-- Cari User --}}
                                    <div>
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            placeholder="Cari User"
                                            class="border-2 rounded-lg border-gray-400 py-[9px] text-sm pl-4"
                                            style="width: 950px;">
                                    </div>
                                    {{-- Tombol Cari --}}
                                    <button type="submit"
                                        class="bg-blue-600 py-1 px-3 h-9 rounded-lg text-white font-semibold  hover:bg-blue-800 cursor-pointer">
                                        <span class="mr-2">Cari</span>
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                    {{-- Tombol Reset --}}
                                    <div
                                        class="bg-gray-500 px-3 py-1 t-1 rounded-lg text-white font-semibold h-9 hover:bg-gray-600 cursor-pointer">
                                        <a href="{{ route('users.index') }}">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Kotak Border --}}

                        <main class="px-6 ">

                            <div class="overflow-hidden rounded-xl border border-black mb-10">
                                <table class="min-w-full">
                                    <thead class="bg-blue-500 text-white font-bold">
                                        <tr>
                                            <th class="py-3 px-4 border border-gray-500 text-center">No</th>
                                            <th class="py-3 px-4 border border-gray-500 text-left">Nama User</th>
                                            <th class="py-3 px-4 border border-gray-500 text-left">Email</th>
                                            <th class="py-3 px-4 border border-gray-500 w-96 p-24">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr class="hover:bg-gray-100 transition duration-300">
                                                <td class="px-4 py-3 text-center text-xs font text-black-500 border border-gray-500">
                                                    {{ $users->firstItem() + $index }}
                                                </td>
                                                <td class="py-2 px-4 border border-gray-500">{{ $user->nama_user }}</td>
                                                <td class="py-2 px-4 border border-gray-500">{{ $user->email }}</td>
                                                <td class="py-2 px-4 border border-gray-500">
                                                    <div class="flex justify-center gap-5 w-96">
                                                        <a href="{{ route('users.edit', $user->id_user) }}" class="text-white bg-blue-500 hover:bg-blue-700 rounded-xl py-2 px-8 font-semibold">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $user->id_user }}" action="{{ route('users.destroy', $user->id_user) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="text-white bg-red-500 hover:bg-red-700 rounded-xl py-2 px-8 font-semibold" onclick="confirmDelete({{ $user->id_user }})">
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
                        {{ $users->links() }} <!-- Menambahkan pagination -->
                    </div>
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

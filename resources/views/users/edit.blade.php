@extends('layouts.app')

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@section('content')
<div class="flex h-screen bg-gray-100"> <!-- Kontainer utama dengan latar belakang abu-abu -->

    {{-- Include sidebar --}}
    @include('layouts.sidebar')

    <!-- Konten Utama -->
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-semibold mb-6">Edit User</h1>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('users.update', $user->id_user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama_user" class="block text-gray-700 font-bold mb-2">Nama:</label>
                    <input type="text" id="nama_user" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" required class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 transition-colors">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 transition-colors">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 transition-colors" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                    <select name="role" id="role" required class="block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 transition-colors">
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">Simpan</button>
                    <a href="{{ route('users.index') }}" class="text-blue-500 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </main>

    
</div>
@endsection
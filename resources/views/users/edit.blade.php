@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
    <form action="{{ route('user.update', $user->id_user) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nama_user" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
            <input type="text" id="nama_user" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" required class="form-input block w-full border rounded p-2">
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="form-input block w-full border rounded p-2">
        </div>
        
        <div class="mb-4">
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
            <select id="role" name="role" required class="form-select block w-full border rounded p-2">
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update User</button>
            <a href="{{ route('user.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali ke Daftar User</a>
        </div>
    </form>
</div>
@endsection
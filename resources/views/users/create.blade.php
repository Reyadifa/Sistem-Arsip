<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>

<body class="bg-gray-100">

    @extends('layouts.app')

    @section('content')
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-500 to-blue-700 text-white p-6">
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

        <main class="flex-1 p-8 ">
            <div class="form-container p-8 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold form-header p-4 rounded-t">Tambah User</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-3 mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nama_user" class="block text-gray-700 text-sm font-bold mb-2">Nama User</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_user" name="nama_user" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                        <input type="password" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div>
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                        <select id="role" name="role" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        
                    </div>
                    <div>
                        <button type="submit" class="btn-primary bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">Tambah User</button>
                    </div>
                    
                </form>
            </div>
        </main>
    </div>
    @endsection

</body>

</html>
@extends('layouts.app')

@section('content')
    <div class="flex">
        <!--Include Sidebar -->
        @include('layouts.sidebar')

        <main class="flex-1">
            <div class="bg-blue-600 py-14">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white"></span>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-black rounded-full h-14 w-14"></div>
                    </div>
                </div>
            </div>
            {{-- main konten 2 --}}
            <div class="px-10">
                <div
                    class="text-center text-2xl font-bold  sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600 mt-10">
                    <i class="fas fa-user text-4xl text-blue-600 "></i>
                    <h1>Tambah User</h1>
                </div>
                <hr class="border-2 border-gray-500 w-[600px] mx-auto">
                <div class="form-container p-8  rounded-lg">

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
                            <label for="NIP" class="block text-gray-700 text-sm font-bold mb-2">NIP</label>
                            <input type="text"
                                class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="NIP" name="NIP" required>
                        </div>
                        <div>
                            <label for="nama_user" class="block text-gray-700 text-sm font-bold mb-2">Nama User</label>
                            <input type="text"
                                class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:-outline"
                                id="nama_user" name="nama_user" required>
                        </div>
                        <div>
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input type="password"
                                class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:-outline"
                                id="password" name="password" required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi
                                Password</label>
                            <input type="password"
                                class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:-outline"
                                id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div>
                            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                            <select id="role" name="role"
                                class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>

                        </div>
                        <div class="pt-10">
                            <button type="submit"
                                class="btn-primary bg-green-500 px-8 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110 mr-4">Tambah
                                User</button>

                            <button
                                class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary ">Kembali</a> </button>
                        </div>

                    </form>
                </div>

            </div>
        </main>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <main class="flex-1">
            <div class="bg-blue-600 py-14">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white"></span>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-10">
                <div
                    class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600 mt-10">
                    <i class="fas fa-user text-4xl text-blue-600"></i>
                    <h1>Tambah User</h1>
                </div>
                <hr class="border-2 border-gray-500 w-[600px] mx-auto">
                <div class="form-container p-8 rounded-lg">

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
                        {{-- Nama User --}}
                        <div>
                            <label for="nama_user" class="block text-gray-700 text-sm font-bold mb-2">Nama User</label>
                            <input type="text"
                                class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nama_user" name="nama_user" required>
                        </div>
                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password"
                                    class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="password" required>
                                <span class="absolute inset-y-0 right-2 flex items-center pr-3 cursor-pointer"
                                    id="tombol">
                                    <i id="eye-icon" class="fa-solid fa-eye text-gray-600"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Konfirmasi --}}
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi
                                Password</label>
                            <div class="relative">
                                <input type="password"
                                    class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline relative"
                                    id="password_confirmation" name="password_confirmation" required>
                                <span class="absolute inset-y-0 right-2 flex items-center pr-3 cursor-pointer"
                                    id="tombol_confirmation">
                                    <i id="eye-icon-confirmation" class="fa-solid fa-eye text-gray-600"></i>
                                </span>
                            </div>
                        </div>
                        {{-- Input role user dan admin --}}
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                            <div class="flex items-center border border-gray-500 rounded-lg px-4 text-lg space-x-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" id="role-admin" name="role" value="1"
                                        class="hidden peer" />
                                    <span
                                        class="text-gray-700 peer-checked:text-white peer-checked:bg-gray-500 peer-checked:rounded-lg px-3 py-2 m-1 h-10 flex items-center font-bold hover:bg-blue-100 transition rounded-lg">
                                        Admin
                                    </span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" id="role-user" name="role" value="2"
                                        class="hidden peer" />
                                    <span
                                        class="text-gray-700 peer-checked:text-white peer-checked:bg-gray-500 peer-checked:rounded-lg px-3 py-2 h-10 flex items-center font-bold hover:bg-blue-100 transition rounded-lg">
                                        User
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-10">
                            <button type="submit"
                                class="btn-primary bg-green-500 px-8 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110 mr-4">Tambah
                                User</button>

                            <a href="{{ route('users.index') }}"
                                class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Function gasan lihat password
        function icon(inputId, iconId) {
            const passwordField = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Password 
        const tombol = document.getElementById('tombol');
        tombol.addEventListener('click', () => icon("password", "eye-icon"));

        // confir password
        const tombol_confirmation = document.getElementById('tombol_confirmation');
        tombol_confirmation.addEventListener('click', () => icon("password_confirmation", "eye-icon-confirmation"));
    </script>

@endsection

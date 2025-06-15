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
                        <div class="notification-success bg-green-500 text-white p-3 mb-4 rounded relative">
                            {{ session('success') }}
                            <button onclick="this.parentElement.style.display='none'" 
                                    class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                                &times;
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="notification-error bg-red-500 text-white p-3 mb-4 rounded relative">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button onclick="this.parentElement.style.display='none'" 
                                    class="absolute top-2 right-2 text-white text-xl bg-transparent border-none cursor-pointer">
                                &times;
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- NIP -->
                        <div>
                            <label for="NIP" class="block text-gray-700 text-sm font-bold mb-2">NIP</label>
                            <input type="text"
                                class="appearance-none rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('NIP') border-red-500 @enderror"
                                id="NIP" name="NIP" 
                                placeholder="Masukkan NIP"
                                value="{{ old('NIP') }}" required>
                            @error('NIP')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama User -->
                        <div>
                            <label for="nama_user" class="block text-gray-700 text-sm font-bold mb-2">Nama User</label>
                            <input type="text"
                                class="appearance-none rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_user') border-red-500 @enderror"
                                id="nama_user" name="nama_user"
                                placeholder="Masukkan Nama User"
                                value="{{ old('nama_user') }}" required>
                            @error('nama_user')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password"
                                    class="appearance-none rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                                    name="password" 
                                    placeholder="Masukkan Password" required>
                                <span class="absolute inset-y-0 right-2 flex items-center pr-3 cursor-pointer"
                                    id="tombol">
                                    <i id="eye-icon" class="fa-solid fa-eye text-gray-600"></i>
                                </span>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password"
                                    class="appearance-none border-gray-500 rounded-lg border w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Masukkan Kembali Password" required>
                                <span class="absolute inset-y-0 right-2 flex items-center pr-3 cursor-pointer"
                                    id="tombol_confirmation">
                                    <i id="eye-icon-confirmation" class="fa-solid fa-eye text-gray-600"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                            <div class="grid grid-cols-3 gap-2 border border-gray-500 rounded-lg p-2">
                                <!-- Pendataan -->
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="role" value="1" class="hidden peer" 
                                        {{ old('role') == '1' ? 'checked' : '' }} />
                                    <span class="text-gray-700 peer-checked:text-white peer-checked:bg-blue-500 peer-checked:rounded-lg px-3 py-2 w-full text-center font-bold hover:bg-blue-100 transition rounded-lg">
                                        Pendataan
                                    </span>
                                </label>

                                <!-- Pelayanan -->
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="role" value="2" class="hidden peer" 
                                        {{ old('role') == '2' ? 'checked' : '' }} />
                                    <span class="text-gray-700 peer-checked:text-white peer-checked:bg-green-500 peer-checked:rounded-lg px-3 py-2 w-full text-center font-bold hover:bg-green-100 transition rounded-lg">
                                        Pelayanan
                                    </span>
                                </label>

                                <!-- Pengarsipan -->
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="role" value="3" class="hidden peer" 
                                        {{ old('role') == '3' ? 'checked' : '' }} />
                                    <span class="text-gray-700 peer-checked:text-white peer-checked:bg-orange-500 peer-checked:rounded-lg px-3 py-2 w-full text-center font-bold hover:bg-orange-100 transition rounded-lg">
                                        Pengarsipan
                                    </span>
                                </label>
                            </div>
                            @error('role')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="pt-10">
                            <button type="submit"
                                class="btn-submit bg-green-500 px-6 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110 mr-4">
                                Simpan
                            </button>

                            <a href="{{ route('users.index') }}"
                                class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Function untuk toggle password visibility
        function togglePassword(inputId, iconId) {
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

        // Event listeners untuk toggle password
        document.getElementById('tombol').addEventListener('click', () => {
            togglePassword("password", "eye-icon");
        });

        document.getElementById('tombol_confirmation').addEventListener('click', () => {
            togglePassword("password_confirmation", "eye-icon-confirmation");
        });

        // Auto-hide notifications after 5 seconds (hanya untuk notifikasi, bukan tombol)
        setTimeout(() => {
            const notifications = document.querySelectorAll('.notification-success, .notification-error');
            notifications.forEach(notification => {
                if (notification.style.display !== 'none') {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.style.display = 'none', 300);
                }
            });
        }, 5000);
    </script>

@endsection
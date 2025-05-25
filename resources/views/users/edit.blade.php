@extends('layouts.app')

@section('content')
    <div class="flex h-screen bg-white">
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
                <div class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600 mt-10">
                    <i class="fas fa-user text-4xl text-blue-600"></i>
                    <h1>Edit User</h1>
                </div>
                <hr class="border-2 border-gray-500 w-[600px] mx-auto">

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-3 mb-4 rounded relative mt-6">
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

                <div class="p-14">
                    <form action="{{ route('users.update', $user->NIP) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- NIP (readonly) -->
                        <div class="mb-3">
                            <label for="NIP" class="block text-gray-700 font-bold mb-2">NIP:</label>
                            <input type="text" id="NIP" name="NIP" value="{{ $user->NIP }}" readonly
                                class="block w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                            <small class="text-gray-500">NIP tidak dapat diubah</small>
                        </div>

                        <!-- Nama User -->
                        <div class="mb-3">
                            <label for="nama_user" class="block text-gray-700 font-bold mb-2">Nama User:</label>
                            <input type="text" id="nama_user" name="nama_user"
                                value="{{ old('nama_user', $user->nama_user) }}" required
                                class="block w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 transition-colors @error('nama_user') border-red-500 @enderror">
                            @error('nama_user')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="block w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 transition-colors @error('password') border-red-500 @enderror"
                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                <span class="absolute inset-y-0 right-2 flex items-center pr-3 cursor-pointer" id="toggle-password">
                                    <i id="password-icon" class="fa-solid fa-eye text-gray-600"></i>
                                </span>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password:</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="block w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 transition-colors"
                                    placeholder="Konfirmasi password baru">
                                <span class="absolute inset-y-0 right-2 flex items-center pr-3 cursor-pointer" id="toggle-password-confirmation">
                                    <i id="password-confirmation-icon" class="fa-solid fa-eye text-gray-600"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Role</label>
                            <div class="grid grid-cols-3 gap-2 border border-gray-500 rounded-lg p-2">
                                <!-- Pendataan -->
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="role" value="1" class="hidden peer" 
                                        {{ old('role', $user->role) == 1 ? 'checked' : '' }} />
                                    <span class="text-gray-700 peer-checked:text-white peer-checked:bg-blue-500 peer-checked:rounded-lg px-3 py-2 w-full text-center font-bold hover:bg-blue-100 transition rounded-lg">
                                        Pendataan
                                    </span>
                                </label>

                                <!-- Pelayanan -->
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="role" value="2" class="hidden peer" 
                                        {{ old('role', $user->role) == 2 ? 'checked' : '' }} />
                                    <span class="text-gray-700 peer-checked:text-white peer-checked:bg-green-500 peer-checked:rounded-lg px-3 py-2 w-full text-center font-bold hover:bg-green-100 transition rounded-lg">
                                        Pelayanan
                                    </span>
                                </label>

                                <!-- Pengarsipan -->
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="role" value="3" class="hidden peer" 
                                        {{ old('role', $user->role) == 3 ? 'checked' : '' }} />
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
                        <div class="flex mt-12">
                            <button type="submit"
                                class="bg-green-500 px-6 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110 mr-4">
                                Simpan Perubahan
                            </button>
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
        // Toggle password visibility
        function togglePasswordVisibility(inputId, iconId) {
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

        // Event listeners
        document.getElementById('toggle-password').addEventListener('click', () => {
            togglePasswordVisibility('password', 'password-icon');
        });

        document.getElementById('toggle-password-confirmation').addEventListener('click', () => {
            togglePasswordVisibility('password_confirmation', 'password-confirmation-icon');
        });

        // Auto-hide error notifications after 5 seconds
        setTimeout(() => {
            const notifications = document.querySelectorAll('.bg-red-500');
            notifications.forEach(notification => {
                if (notification.style.display !== 'none') {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.style.display = 'none', 300);
                }
            });
        }, 5000);
    </script>
@endsection
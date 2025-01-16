<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    {{-- tailwind config --}}
    @vite('resources/css/app.css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-center bg-no-repeat flex items-center justify-center min-h-screen px-4 sm:px-0"
    style="background-image: url('img/bg.jpg');">
    <!-- Form Isi -->
    <div class="bg-blue-600 bg-opacity-80 rounded-3xl py-8 w-full max-w-md text-center relative shadow-xl sm:w-[460px]">
        <!-- Gambar -->
        <div class="bg-white rounded-full w-40 h-40 sm:w-56 sm:h-56 flex mx-auto absolute inset-x-0 -top-20 sm:-top-28">
            <img alt="BPKAD" class="mx-auto mb-4 h-24 sm:h-32 flex justify-center my-8 sm:my-12"
                src="{{ asset('img/bpkad.png') }}" />
        </div>
        <div class="p-0 mt-20 sm:mt-32">
            <h1 class="text-white text-3xl sm:text-4xl font-bold mb-4">
                Selamat Datang Di SIM-A
            </h1>
        </div>

        <!-- Laravel Form -->
        <form action="{{ url('/login') }}" method="POST" class="p-6 sm:p-10">
            @csrf <!-- Laravel CSRF protection -->

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="mb-4 bg-red-500 text-white text-center py-2 px-4 rounded-lg">
                    Login gagal, mohon kembali cek username dan password Anda.
                </div>
            @endif

            <!-- Nama User Input -->
            <div class="mb-4">
                <label class="block text-lg sm:text-xl text-white font-bold text-left mb-2" for="nama_user">
                    Nama User
                </label>
                <div class="relative ">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input
                        class="text-lg sm:text-xl pl-10 pr-4 py-2 rounded-full w-full @error('nama_user') border-red-500 @enderror"
                        id="nama_user" name="nama_user" placeholder="Nama User" type="text"
                        value="{{ old('nama_user') }}" required />
                </div>

            </div>


            <!-- Password Input -->
            <div class="mb-6">
                <label class="block text-lg sm:text-xl text-white font-bold text-left mb-2" for="password">
                    Password
                </label>
                <div class="relative ">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-lock text-black"></i>
                    </span>
                    <input
                        class="text-lg sm:text-xl pl-10 pr-10 py-2 rounded-full w-full @error('password') border-red-500 @enderror"
                        id="password" name="password" placeholder="Password" type="password" required />
                    <!-- Icon Mata -->
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                        onclick="togglePasswordVisibility()">
                        <i id="eye-icon" class="fa-solid fa-eye text-gray-600"></i>
                    </span>
                </div>
            </div>

            <!-- Login Button -->
            <button
                class="bg-yellow-400 text-lg sm:text-xl text-black font-bold py-2 px-4 rounded-full w-full mt-3 transform transition-transform duration-300 hover:scale-110 hover:bg-yellow-500">
                Log In
            </button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>


</html>

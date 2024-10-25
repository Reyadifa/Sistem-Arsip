<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-center bg-no-repeat flex items-center justify-center min-h-screen " style="background-image: url('img/bg.jpg');">
    <!-- Form Isi -->
    <div class="bg-blue-600 bg-opacity-80 rounded-3xl py-8 w-[460px] text-center relative shadow-xl">
        <!-- Gambar -->
        <div class="bg-white rounded-full w-56 h-56 flex mx-auto absolute inset-0 -top-28">
            <img alt="BPKAD" class="mx-auto mb-4 h-32 flex justify-center my-12" height="150" src="{{ asset('img/bpkad.png') }}" width="150" />
        </div>
        <div class="p-0">
            <h1 class="text-white text-4xl font-bold mb- mt-32 ">
                Selamat Datang Di SIM-A
            </h1>
        </div>

        <!-- Laravel Form -->
        <form action="{{ url('/login') }}" method="POST" class="p-10">
            @csrf <!-- Laravel CSRF protection -->

            <!-- Username Input -->
            <div class="mb-4">
                <label class="block text-xl text-white font-bold text-left mb-2" for="username">
                    Username
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input class="text-xl pl-10 pr-4 py-2 rounded-full w-full @error('email') border-red-500 @enderror"
                        id="email" name="email" placeholder="Username" type="text" value="{{ old('email') }}" required />

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label class="block text-xl text-white font-bold text-left mb-2" for="password">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-lock text-black"></i>
                    </span>
                    <input class="text-xl pl-10 pr-10 py-2 rounded-full w-full @error('password') border-red-500 @enderror"
                        id="password" name="password" placeholder="Password" type="password" required />
                    <!-- Icon Mata -->
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility()">
                        <i id="eye-icon" class="fa-solid fa-eye text-gray-600"></i>
                    </span>

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Error Section -->
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Button -->
            <button class="bg-yellow-400 text-xl text-black font-bold py-2 px-4 rounded-full w-full mt-3 transform transition-transform duration-300 hover:scale-110 hover:bg-yellow-500">
                Log In
            </button>
        </form>
    </div>

    <!-- Script untuk Toggle Password Visibility -->
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");

            // Jika tipe input saat ini adalah password, ubah menjadi text
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash"); // Ubah ikon menjadi mata tertutup
            } else {
                // Jika tipe input adalah text, ubah kembali menjadi password
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye"); // Ubah ikon kembali ke mata terbuka
            }
        }
    </script>

</body>

</html>

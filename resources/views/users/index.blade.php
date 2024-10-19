<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- tailwind config --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex h-screen"> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        <section class="py-4 flex-grow"> <!-- Penambahan padding untuk section -->
            <div class="max-w-10xl rounded-lg p-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-6">Daftar User</h2>
                        <div class="flex justify-between items-center mb-4">
                            <a href="{{ route('users.create') }}"
                                class="bg-green-500 text-white px-4 py-3 rounded-md hover:bg-green-600 font-bold transition duration-300"><i
                                    class="fa-solid fa-plus mr-2 font-bold text-lg"></i> Tambah User</a>
                        </div>
                        <table class="min-w-full bg-white border-collapse">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-4 border-b border-gray-300 text-left">Nama User</th>
                                    <th class="py-3 px-4 border-b border-gray-300 text-left">Email</th>
                                    <th class="py-3 px-4 border-b border-gray-300 w-96 p-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-100 transition duration-300">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->nama_user }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->email }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 flex space-x-2">

                                            <div class="flex justify-center gap-5 w-96">
                                                <a href="{{ route('users.edit', $user->id_user) }}"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 rounded-xl py-2 px-8 font-semibold"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>

                                                <form id="delete-form-{{ $user->id_user }}"
                                                    action="{{ route('users.destroy', $user->id_user) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-white bg-red-500 hover:bg-red-700 rounded-xl py-2 px-8 font-semibold"
                                                        onclick="confirmDelete({{ $user->id_user }})">
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
                    <div class="p-4">
                        {{ $users->links() }} <!-- Menambahkan pagination -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    {{-- js arsip --}}
    <script src="{{ asset('js/user.js') }}"></script>


</body>

</html>

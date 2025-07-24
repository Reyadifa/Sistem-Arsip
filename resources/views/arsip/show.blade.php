@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    @include('layouts.sidebar')

    <main class="flex-1 bg-gray-200">
        <div class="bg-blue-600 py-10">
            <div class="flex items-center">
                <span class="material-icons text-4xl text-white">archive</span>
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

        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-10 mx-10 my-8">
            <div class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                <span class="material-icons text-blue-500 text-4xl">archive</span>
                <h1>Detail Arsip</h1>
            </div>

            <hr class="border-2 border-gray-500 w-[600px] mx-auto">

            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4">Informasi Arsip</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">NPWP:</p>
                            <p>{{ $usaha->npwp }}</p>
                        </div>
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">Nama Usaha:</p>
                            <p>{{ $usaha->nama_usaha }}</p>
                        </div>
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">Alamat Usaha:</p>
                            <p>{{ $usaha->alamat_usaha }}</p>
                        </div>
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">Nama Pemilik:</p>
                            <p>{{ $usaha->nama_pemilik }}</p>
                        </div>
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">Alamat Pemilik:</p>
                            <p>{{ $usaha->alamat_pemilik }}</p>
                        </div>
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">Bulan:</p>
                            <p>{{ $arsip->bulan }}</p>
                        </div>
                        <div class="p-4 rounded-lg border border-gray-500">
                            <p class="font-bold">Tahun:</p>
                            <p>{{ $arsip->tahun }}</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold mb-4">File Terlampir</h2>
                <div class="mb-6 flex gap-6 justify-between">
                    <div class="flex gap-6 items-center">
                        @if ($arsip->file_path)
                            <a href="{{ Storage::url($arsip->file_path) }}" target="_blank"
                                class="bg-gray-500 px-6 py-3 rounded-lg text-white font-semibold transform transition-transform duration-200 hover:scale-110 hover:underline">
                                Lihat File
                            </a>
                        @else
                            <p class="text-red-500">Tidak ada file yang diunggah.</p>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('arsip.index') }}"
                            class="px-6 py-3 text-white font-bold bg-blue-500 rounded-lg hover:bg-blue-600 transform transition-transform duration-200 hover:scale-110">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('delete-btn').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    });
</script>
@endsection

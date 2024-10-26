@extends('layouts.app')

@section('content')

    @include('layouts.sidebar')


    <div class="">

        <div class="flex items-center space-x-4 pl-10 pt-10 mb-20">
            <i class="fas fa-book text-4xl text-blue-600 "></i>
            <h2 class="text-4xl font-bold">Tambah Peminjaman</h2>
        </div>
        

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <main class="p-10 bg-blue-500 max-w-4xl rounded-xl mx-auto space-y-6 shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Dropdown untuk memilih NPWP dan Nama Usaha -->
                    <div>
                        <label for="npwp" class="block font-bold text-white mb-1">Pilih NPWP dan Nama Usaha</label>
                        <select name="npwp" id="npwp" class="w-full p-3 rounded-lg" onchange="updateArsipDropdown()">
                            <option value="">Pilih NPWP dan Nama Usaha</option>
                            @foreach ($arsipsGrouped as $key => $arsips)
                                @php
                                    $firstArsip = $arsips[0];
                                @endphp
                                <option value="{{ $firstArsip->npwp }}">{{ $firstArsip->npwp }} -
                                    {{ $firstArsip->nama_usaha }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Arsip yang muncul setelah memilih NPWP -->
                    <div id="arsip-container" style="display: none;">
                        <label for="arsip_id" class="block font-bold text-white mb-1">Pilih Arsip</label>
                        <select name="arsip_id" id="arsip_id" class="w-full p-3 rounded-lg" onchange="updateFileInfo()">
                            <option value="">Pilih Arsip</option>
                            <!-- Options will be added dynamically -->
                        </select>
                    </div>

                    <!-- Input No KTP -->
                    <div>
                        <label for="no_ktp" class="block font-bold text-white mb-1">No KTP</label>
                        <input type="text" class="w-full p-3 rounded-lg" id="no_ktp" name="no_ktp"
                            placeholder="Masukkan No KTP" value="{{ old('no_ktp') }}" required>
                    </div>

                    <!-- Input Nama Peminjam -->
                    <div>
                        <label for="nama_peminjam" class="block font-bold text-white mb-1">Nama Peminjam</label>
                        <input type="text" class="w-full p-3 rounded-lg" id="nama_peminjam" name="nama_peminjam"
                            placeholder="Masukkan Nama Peminjam" value="{{ old('nama_peminjam') }}" required>
                    </div>

                    <!-- Dropdown Status -->
                    <div>
                        <label for="status" class="block font-bold text-white mb-1">Status</label>
                        <select name="status" id="status" class="w-full p-3 rounded-lg" required>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                            <option value="Terlambat">Terlambat</option>
                        </select>
                    </div>

                    <!-- Input Tanggal Pinjam -->
                    <div>
                        <label for="tgl_minjam" class="block font-bold text-white mb-1">Tanggal Pinjam</label>
                        <input type="date" class="w-full p-3 rounded-lg" id="tgl_minjam" name="tgl_minjam"
                            placeholder="Pilih Tanggal Pinjam" value="{{ old('tgl_minjam') }}" required>
                    </div>

                    <!-- Input Tanggal Kembali -->
                    <div>
                        <label for="tgl_kembali" class="block font-bold text-white mb-1">Tanggal Kembali</label>
                        <input type="date" class="w-full p-3 rounded-lg" id="tgl_kembali" name="tgl_kembali"
                            placeholder="Pilih Tanggal Kembali" value="{{ old('tgl_kembali') }}">
                    </div>

                    <!-- Textarea Keperluan -->
                    <div class="col-span-2">
                        <label for="keperluan" class="block font-bold text-white mb-1">Keperluan</label>
                        <textarea class="w-full p-3 rounded-lg" id="keperluan" name="keperluan" rows="3"
                            placeholder="Jelaskan keperluan Anda" required>{{ old('keperluan') }}</textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="text-center mt-8">
                    <button type="submit"
                        class="w-full md:w-1/2 bg-green-500 py-3 rounded-xl text-white font-bold hover:bg-green-600 transition duration-300">
                        Simpan
                    </button>
                </div>
            </main>









        </form>
    </div>

    <script>
        const arsipsGrouped = @json($arsipsGrouped); // Mengambil data dari controller

        function updateArsipDropdown() {
            const npwpSelect = document.getElementById('npwp');
            const arsipSelect = document.getElementById('arsip_id');
            const arsipContainer = document.getElementById('arsip-container');

            const selectedNpwp = npwpSelect.value;
            arsipSelect.innerHTML = '<option value="">Pilih Arsip</option>'; // Reset options

            if (selectedNpwp) {
                arsipContainer.style.display = 'block';
                const arsips = arsipsGrouped[selectedNpwp];
                arsips.forEach(arsip => {
                    const option = document.createElement('option');
                    option.value = arsip.id;
                    option.textContent =
                        `${arsip.nama_usaha} - Kategori: ${arsip.kategori.nama_kategori}, bulan: ${arsip.bulan}, tahun: ${arsip.tahun}`;
                    option.setAttribute('data-file', arsip.file);
                    arsipSelect.appendChild(option);
                });
            } else {
                arsipContainer.style.display = 'none';
            }
        }

        function updateFileInfo() {
            const select = document.getElementById('arsip_id');
            const fileInfo = document.getElementById('file-info');
            const fileName = document.getElementById('file-name');
            const hiddenFileInput = document.getElementById('file_arsip');

            const selectedOption = select.options[select.selectedIndex];
            const file = selectedOption.getAttribute('data-file');

            if (file) {
                fileInfo.style.display = 'block';
                fileName.textContent = 'File: ' + file;
                hiddenFileInput.value = file; // Menyimpan file di input hidden
            } else {
                fileInfo.style.display = 'none';
                fileName.textContent = '';
                hiddenFileInput.value = ''; // Mengosongkan input hidden jika tidak ada file
            }
        }
    </script>

@endsection

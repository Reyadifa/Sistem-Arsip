@extends('layouts.app')

@section('content')

    @include('layouts.sidebar')


    <div>
        <div class="pt-1">

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

            <main class="p-10 bg-white max-1xl rounded-xl space-y-6 shadow-2xl mx-2">
                <div class="text-center text-2xl font-bold  sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600"> 
                    <i class="fas fa-book text-4xl text-blue-600 "></i>      
                    <h1>Tambah Peminjaman</h1>
                </div>
            
                <hr class="border-2 border-gray-500">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    
                    <!-- Dropdown untuk memilih NPWP dan Nama Usaha -->
                    <div>
                        <label for="npwp" class="block font-bold text-black mb-1">Pilih NPWP dan Nama Usaha</label>
                        <select name="npwp" id="npwp" class="w-full p-3 rounded-lg border-black border" onchange="updateArsipDropdown()">
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

                    <div id="arsip-container">
                        <label for="arsip_id" class="block font-bold text-black mb-1">Pilih Arsip</label>
                        <select name="arsip_id" id="arsip_id" class="w-full p-3 rounded-lg border-black border" onchange="updateFileInfo()">
                            <option value="">Pilih Arsip</option>
                        </select>
                    </div>

                    <!-- Input Tanggal Pinjam -->
                    <div>
                        <label for="tgl_minjam" class="block font-bold text-black mb-1">Tanggal Pinjam</label>
                        <input type="date" class="w-full p-3 rounded-lg border-black border" id="tgl_minjam" name="tgl_minjam"
                            placeholder="Pilih Tanggal Pinjam" value="{{ old('tgl_minjam') }}" required>
                    </div>

                    <!-- Input Tanggal Kembali -->
                    <div>
                        <label for="tgl_kembali" class="block font-bold text-black mb-1">Tanggal Kembali</label>
                        <input type="date" class="w-full p-3 rounded-lg border-black border" id="tgl_kembali" name="tgl_kembali"
                            placeholder="Pilih Tanggal Kembali" value="{{ old('tgl_kembali') }}">
                    </div>

                    <!--new Input Nama Peminjam -->
                    <div>
                            <label for="nama_peminjam" class="block font-bold text-black mb-1">Nama Peminjam</label>
                            <input type="text" class="w-full p-3 rounded-lg border-black border" id="nohp_peminjam" name="nama_peminjam"
                            placeholder="Masukkan Nama Peminjam" value="{{ old('nama_peminjam') }}" required>
                    </div> 

                    <!-- Dropdown Status -->
                    <div>
                        <label for="status" class="block font-bold text-black mb-1">Status</label>
                        <select name="status" id="status" class="w-full p-3 rounded-lg border-black border" required>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                            <option value="Terlambat">Terlambat</option>
                        </select>
                    </div>
                    
                    <!-- Textarea Keperluan -->
                    <div class="col-span-2">
                        <label for="keperluan" class="block font-bold text-black mb-1">Keperluan</label>
                        <textarea class="w-full p-3 rounded-lg border-black border" id="keperluan" name="keperluan" rows="3"
                            placeholder="Jelaskan keperluan Anda" required>{{ old('keperluan') }}</textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="text-center flex gap-5">
                    <button type="submit"
                        class="  bg-green-500 px-8 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110">
                        Simpan
                    </button>

                    <a href="/peminjaman"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">Kembali</a>


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

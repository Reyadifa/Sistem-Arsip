@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Peminjaman</h2>

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

        <div class="mb-3">
            <label for="npwp" class="form-label">Pilih NPWP dan Nama Usaha</label>
            <select name="npwp" id="npwp" class="form-select" onchange="updateArsipDropdown()">
                <option value="">Pilih NPWP dan Nama Usaha</option>
                @foreach ($arsipsGrouped as $key => $arsips)
                    @php
                        // Mengambil NPWP dan nama usaha dari grup pertama
                        $firstArsip = $arsips[0];
                    @endphp
                    <option value="{{ $firstArsip->npwp }}">{{ $firstArsip->npwp }} - {{ $firstArsip->nama_usaha }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="arsip-container" style="display: none;">
            <label for="arsip_id" class="form-label">Pilih Arsip</label>
            <select name="arsip_id" id="arsip_id" class="form-select" onchange="updateFileInfo()">
                <option value="">Pilih Arsip</option>
                <!-- Options will be added dynamically -->
            </select>
        </div>


        <div class="mb-3">
            <label for="no_ktp" class="form-label">No KTP</label>
            <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required>
        </div>

        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required>{{ old('keperluan') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tgl_minjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_minjam" name="tgl_minjam" value="{{ old('tgl_minjam') }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="{{ old('tgl_kembali') }}">
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Dikembalikan">Dikembalikan</option>
                <option value="Terlambat">Terlambat</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
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
                option.textContent = `${arsip.nama_usaha} - Kategori: ${arsip.kategori.nama_kategori}, bulan: ${arsip.bulan}, tahun: ${arsip.tahun}`;
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
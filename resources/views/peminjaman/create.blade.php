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
            <label for="arsip_id" class="form-label">Pilih Arsip</label>
            <select name="arsip_id" id="arsip_id" class="form-select" onchange="updateFileInfo()">
                <option value="">Pilih Arsip</option>
                @foreach ($arsips as $arsip)
                <option value="{{ $arsip->id }}" data-file="{{ $arsip->file }}">
                    {{ $arsip->nama_usaha }} - NPWP: {{ $arsip->npwp }}, Kategori: {{ $arsip->kategori->nama_kategori }}, bulan: {{ $arsip->bulan }}, tahun: {{ $arsip->tahun }}
                </option>                
                @endforeach
            </select>
        </div>        

        <!-- Hidden field untuk menyimpan file arsip yang dipilih -->
        <input type="hidden" id="file_arsip" name="file_arsip" value="{{ old('file_arsip') }}">

        <div class="mb-3" id="file-info" style="display: none;">
            <label class="form-label">File Arsip</label>
            <p id="file-name"></p>
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
    function updateFileInfo() {
        const select = document.getElementById('arsip_id');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const hiddenFileInput = document.getElementById('file_arsip');

        const selectedOption = select.options[select.selectedIndex];
        const file = selectedOption.getAttribute('data-file');

        console.log(file); // Debugging

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
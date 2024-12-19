@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Peminjaman</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="arsip_id" class="form-label">Pilih Arsip</label>
            <select name="arsip_id" id="arsip_id" class="form-select" onchange="updateFileInfo()">
                <option value="">Pilih Arsip</option>
                @foreach ($arsips as $arsip)
                <option value="{{ $arsip->id }}" data-file="{{ $arsip->file }}"
                    {{ $peminjaman->arsip_id == $arsip->id ? 'selected' : '' }}>
                    {{ $arsip->nama_usaha }} - NPWP: {{ $arsip->npwp }}, Kategori: {{ $arsip->kategori->nama_kategori }}, bulan: {{ $arsip->bulan }}, tahun: {{ $arsip->tahun }}
                </option>                
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
        </div>

        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required>{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tgl_minjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_minjam" name="tgl_minjam" value="{{ old('tgl_minjam', $peminjaman->tgl_minjam) }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="{{ old('tgl_kembali', $peminjaman->tgl_kembali) }}">
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="Dikembalikan" {{ $peminjaman->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="Terlambat" {{ $peminjaman->status == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
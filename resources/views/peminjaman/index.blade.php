@extends('layouts.app') <!-- Ganti dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Daftar Peminjaman</h1>

    @foreach ($peminjamans as $peminjaman)
        <div class="card mb-3">
            <div class="card-body">
                <h5>No KTP: {{ $peminjaman->no_ktp }}</h5>
                <p>Nama Peminjam: {{ $peminjaman->nama_peminjam }}</p>
                <p>Keperluan: {{ $peminjaman->keperluan }}</p>
                <p>Status: {{ $peminjaman->status }}</p>

                @if ($peminjaman->arsip && $peminjaman->arsip->file_path)
                <a href="{{ asset('storage/' . $peminjaman->arsip->file_path) }}" target="_blank">
                    Lihat File
                </a>
                <hr class="bg-white">
            @endif
            

            </div>
        </div>
    @endforeach
</div>
@endsection
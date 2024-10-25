<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Arsip;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamanController extends Controller


{
    // Menampilkan form peminjaman
    public function create()
    {
        $arsips = Arsip::with('kategori')->get(); // Pastikan file ikut terambil
        return view('peminjaman.create', compact('arsips'));
    }

    // Menyimpan data peminjaman
    public function store(Request $request)
{
    
    $request->validate([
        'arsip_id' => 'required|exists:arsips,id',
        'no_ktp' => 'required|string',
        'nama_peminjam' => 'required|string',
        'keperluan' => 'required|string',
        'tgl_minjam' => 'required|date',
        'tgl_kembali' => 'nullable|date',
        'status' => 'required|string',
    ]);

    $peminjaman = new Peminjaman();
    $peminjaman->arsip_id = $request->arsip_id;
    $peminjaman->no_ktp = $request->no_ktp;
    $peminjaman->nama_peminjam = $request->nama_peminjam;
    $peminjaman->keperluan = $request->keperluan;
    $peminjaman->tgl_minjam = $request->tgl_minjam;
    $peminjaman->tgl_kembali = $request->tgl_kembali;
    $peminjaman->status = $request->status;

    // Ambil file arsip berdasarkan arsip_id
    $arsip = Arsip::find($request->arsip_id);
if ($arsip) {
    $peminjaman->file_path = $arsip->file_path;
}

    $peminjaman->save();

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan.');
}


public function index()
    {
        $peminjamans = Peminjaman::with('arsip')->get();

        return view('peminjaman.index', compact('peminjamans'));
    }
}
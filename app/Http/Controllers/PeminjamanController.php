<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Arsip;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamanController extends Controller{

    public function create()
    {
        $arsips = Arsip::with('kategori')->get(); // Ambil semua arsip tanpa filter
        $arsipsGrouped = $arsips->groupBy('npwp'); // Kelompokkan berdasarkan NPWP jika perlu
        return view('peminjaman.create', compact('arsipsGrouped'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'arsip_id' => 'required|exists:arsips,id',
            'no_ktp' => 'required|string',
            'nama_peminjam' => 'required|string',
            'alamat_peminjam' => 'required|string',
            'nohp_peminjam' => 'required|string|min:3|max:15',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'nullable|date',
            'status' => 'required|string',
        ]);

        // Periksa apakah arsip sudah dipinjam atau terlambat dikembalikan
        $arsipDipinjam = Peminjaman::where('arsip_id', $request->arsip_id)
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->exists();

        if ($arsipDipinjam) {
            // Notifikasi arsip sudah dipinjam, tetap di halaman create
            return redirect()->back()->withErrors(['arsip_id' => 'Arsip ini sedang dipinjam atau belum dikembalikan.']);
        }

        // Simpan data peminjaman jika arsip tersedia
        $peminjaman = new Peminjaman();
        $peminjaman->arsip_id = $request->arsip_id;
        $peminjaman->no_ktp = $request->no_ktp;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->alamat_peminjam = $request->alamat_peminjam;
        $peminjaman->nohp_peminjam = $request->nohp_peminjam;
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

        // Periksa status setiap peminjaman
        foreach ($peminjamans as $peminjaman) {
            if ($peminjaman->status == 'Dipinjam' && now()->gt($peminjaman->tgl_kembali)) {
                $peminjaman->status = 'Terlambat';
                $peminjaman->save();
            }
        }

        // Ambil data peminjaman dengan pagination
        $peminjamans = Peminjaman::with('arsip')->paginate(10);

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $arsips = Arsip::all(); // Mengambil semua arsip

        return view('peminjaman.edit', compact('peminjaman', 'arsips'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'arsip_id' => 'required|integer',
            'no_ktp' => 'required|string',
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'status' => 'required|string',
        ]);

        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Update data peminjaman
        $peminjaman->update([
            'arsip_id' => $request->arsip_id,
            'no_ktp' => $request->no_ktp,
            'nama_peminjam' => $request->nama_peminjam,
            'keperluan' => $request->keperluan,
            'tgl_minjam' => $request->tgl_minjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => $request->status,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cari data peminjaman berdasarkan id
        $peminjaman = Peminjaman::findOrFail($id);

        // Hapus data peminjaman
        $peminjaman->delete();

        // Redirect kembali ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
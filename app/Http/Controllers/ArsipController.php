<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori; // Pastikan model Kategori diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index()
    {
        $arsips = Arsip::all(); // Mengambil semua data arsip
        return view('arsip.index', compact('arsips')); // Mengirim data ke view
    }

    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori untuk ditampilkan di dropdown
        return view('arsip.create', compact('kategoris')); // Kirim data kategori ke view
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required', // Gunakan id_kategori untuk validasi
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nama_pemilik' => 'required',
            'alamat_pemilik' => 'required', // Tambahkan validasi untuk alamat pemilik
            'npwp' => 'required', // Tambahkan validasi untuk NPWP
            'bulan' => 'required',
            'tahun' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Membuat instance Arsip baru
        $arsip = new Arsip();
        $arsip->id_kategori = $request->id_kategori; // Simpan ID kategori
        $arsip->nama_usaha = $request->nama_usaha;
        $arsip->alamat_usaha = $request->alamat_usaha;
        $arsip->nama_pemilik = $request->nama_pemilik;
        $arsip->alamat_pemilik = $request->alamat_pemilik; // Menyimpan alamat pemilik
        $arsip->npwp = $request->npwp; // Menyimpan NPWP
        $arsip->bulan = $request->bulan; // Menyimpan bulan
        $arsip->tahun = $request->tahun; // Menyimpan tahun

        // Menyimpan file jika ada
        if ($request->hasFile('file')) {
            $arsip->file_path = $request->file('file')->store('uploads'); // Simpan file di folder 'uploads'
        }

        // Simpan data arsip ke database
        $arsip->save();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.'); // Redirect dengan pesan sukses
    }

    public function edit(Arsip $arsip)
    {
        $kategoris = Kategori::all(); // Ambil semua kategori untuk ditampilkan di dropdown
        return view('arsip.edit', compact('arsip', 'kategoris')); // Kirim data arsip dan kategori ke view
    }

    public function update(Request $request, Arsip $arsip)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required', // Gunakan id_kategori untuk validasi
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nama_pemilik' => 'required',
            'alamat_pemilik' => 'required', // Tambahkan validasi untuk alamat pemilik
            'npwp' => 'required', // Tambahkan validasi untuk NPWP
            'bulan' => 'required',
            'tahun' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Memperbarui data arsip
        $arsip->id_kategori = $request->id_kategori; // Memperbarui ID kategori
        $arsip->nama_usaha = $request->nama_usaha;
        $arsip->alamat_usaha = $request->alamat_usaha;
        $arsip->nama_pemilik = $request->nama_pemilik;
        $arsip->alamat_pemilik = $request->alamat_pemilik; // Memperbarui alamat pemilik
        $arsip->npwp = $request->npwp; // Memperbarui NPWP
        $arsip->bulan = $request->bulan; // Memperbarui bulan
        $arsip->tahun = $request->tahun; // Memperbarui tahun

        // Menyimpan file baru jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($arsip->file_path) {
                Storage::delete($arsip->file_path); // Hapus file lama
            }
            $arsip->file_path = $request->file('file')->store('uploads'); // Simpan file baru
        }

        // Simpan perubahan ke database
        $arsip->save();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.'); // Redirect dengan pesan sukses
    }

    public function destroy(Arsip $arsip)
    {
        // Hapus file jika ada
        if ($arsip->file_path) {
            Storage::delete($arsip->file_path); // Hapus file dari penyimpanan
        }
        $arsip->delete(); // Hapus arsip dari database
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.'); // Redirect dengan pesan sukses
    }


// Di dalam ArsipController.php

public function show($id)
{
    // Cari arsip berdasarkan ID
    $arsip = Arsip::findOrFail($id);

    // Mengambil kategori untuk ditampilkan jika perlu
    $kategori = Kategori::find($arsip->id_kategori);

    // Mengembalikan view dengan data arsip dan kategori
    return view('arsip.show', compact('arsip', 'kategori'));
}
}
<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori; // Pastikan model Kategori diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');
    $kategoriId = $request->input('kategori');

    // Mengambil semua kategori untuk dropdown
    $kategoris = Kategori::all();

    // Mengambil arsip dengan kategori, terurut berdasarkan ID secara menurun
    $arsips = Arsip::with('kategori')
        ->when($search, function ($query) use ($search) {
            return $query->where('npwp', 'like', '%' . $search . '%');
        })
        ->when($bulan, function ($query) use ($bulan) {
            return $query->where('bulan', $bulan);
        })
        ->when($tahun, function ($query) use ($tahun) {
            return $query->where('tahun', $tahun);
        })
        ->orderBy('id', 'desc')
        ->paginate(10) // Mengambil 10 arsip per halaman
        ->appends(request()->query()); // Menambahkan semua parameter query ke pagination

    return view('arsip.index', compact('arsips', 'search', 'bulan', 'tahun'));
}




    public function create()
    {
        // Mengambil semua kategori untuk ditampilkan di dropdown
        $kategoris = Kategori::all();
        return view('arsip.create', compact('kategoris'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'id_kategori' => 'required|exists:kategoris,id_kategori', // Validasi ID kategori
        'nama_usaha' => 'required',
        'alamat_usaha' => 'required',
        'nama_pemilik' => 'required',
        'alamat_pemilik' => 'required',
        'npwp' => 'required',
        'bulan' => 'required',
        'tahun' => 'required|integer',
        'file' => 'nullable|file|mimes:pdf|max:2048', // Hanya izinkan file PDF
    ]);

    // Membuat instance Arsip baru
    $arsip = new Arsip();
    $arsip->fill($request->only(['id_kategori', 'nama_usaha', 'alamat_usaha', 'nama_pemilik', 'alamat_pemilik', 'npwp', 'bulan', 'tahun']));

    // Menyimpan file jika ada
    if ($request->hasFile('file')) {
        $arsip->file_path = $this->storeFile($request->file('file'));
    }

    // Simpan data arsip ke database
    $arsip->save();
    return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
}

    public function edit(Arsip $arsip)
    {
        // Mengambil semua kategori untuk ditampilkan di dropdown
        $kategoris = Kategori::all();
        return view('arsip.edit', compact('arsip', 'kategoris'));
    }

    public function update(Request $request, Arsip $arsip)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nama_pemilik' => 'required',
            'alamat_pemilik' => 'required',
            'npwp' => 'required',
            'bulan' => 'required',
            'tahun' => 'required|integer',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Memperbarui data arsip
        $arsip->fill($request->only(['id_kategori', 'nama_usaha', 'alamat_usaha', 'nama_pemilik', 'alamat_pemilik', 'npwp', 'bulan', 'tahun']));

        // Menyimpan file baru jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($arsip->file_path) {
                Storage::disk('public')->delete($arsip->file_path); // Hapus file lama
            }
            $arsip->file_path = $this->storeFile($request->file('file'));
        }

        // Simpan perubahan ke database
        $arsip->save();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy(Arsip $arsip)
{
    // Hapus file jika ada
    if ($arsip->file_path) {
        Storage::disk('public')->delete($arsip->file_path); // Hapus file dari penyimpanan
    }
    $arsip->delete(); // Hapus arsip dari database
    
    // Tambahkan notifikasi untuk penghapusan arsip
    return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
}


    public function show(Arsip $arsip)
    {
        // Mengambil kategori untuk ditampilkan
        $kategori = $arsip->kategori; 
        return view('arsip.show', compact('arsip', 'kategori'));
    }

    private function storeFile($file)
    {
        // Menyimpan file dengan nama unik dan mengembalikan path
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $newName = $originalName . '_' . time() . '.' . $extension; // Tambahkan timestamp untuk menghindari duplikat
        return $file->storeAs('uploads', $newName, 'public'); // Simpan file dengan nama unik
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{

public function index(Request $request)
{
    // Ambil query pencarian dari request
    $search = $request->input('search');
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');
    $kategoriId = $request->input('kategori'); 

    // Mengambil semua kategori untuk dropdown
    $kategoris = Kategori::all();

    // Mengambil arsip dengan kategori
    $arsips = Arsip::with('kategori')
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('npwp', 'like', '%' . $search . '%')
                      ->orWhere('nama_usaha', 'like', '%' . $search . '%');
            });
        })
        ->when($bulan, function ($query) use ($bulan) {
            return $query->where('bulan', $bulan);
        })
        ->when($tahun, function ($query) use ($tahun) {
            return $query->where('tahun', $tahun);
        })
        ->when($kategoriId, function ($query) use ($kategoriId) {
            return $query->where('id_kategori', $kategoriId);
        })
        ->orderBy('tahun', 'desc')
        ->orderByRaw("FIELD(bulan, 'Desember', 'November', 'Oktober', 'September', 'Agustus', 'Juli', 'Juni', 'Mei', 'April', 'Maret', 'Februari', 'Januari') ASC") // Urutkan bulan dari Desember ke Januari
        ->paginate(12)
        ->appends(request()->query());

    return view('arsip.index', compact('arsips', 'search', 'bulan', 'tahun', 'kategoriId', 'kategoris'));
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('arsip.create', compact('kategoris'));
    }

    public function store(Request $request)
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
        'file' => 'file|mimes:pdf|max:2048',
         ]);

    $arsip = new Arsip();
    $arsip->fill($request->only(['id_kategori', 'nama_usaha', 'alamat_usaha', 'nama_pemilik', 'alamat_pemilik', 'npwp', 'bulan', 'tahun']));

    if ($request->hasFile('file')) {
        $arsip->file_path = $this->storeFile($request->file('file'));
    }

    $arsip->save();
    return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function edit(Arsip $arsip)
    {
        $kategoris = Kategori::all();
        return view('arsip.edit', compact('arsip', 'kategoris'));
    }

    public function update(Request $request, Arsip $arsip)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nama_pemilik' => 'required',
            'alamat_pemilik' => 'required',
            'npwp' => 'required',
            'bulan' => 'required',
            'tahun' => 'required|integer',
            'file' => 'file|mimes:pdf|max:2048',
        ]);

        $arsip->fill($request->only(['id_kategori', 'nama_usaha', 'alamat_usaha', 'nama_pemilik', 'alamat_pemilik', 'npwp', 'bulan', 'tahun']));

        if ($request->hasFile('file')) {
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
    $arsip->delete();
    
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
        $newName = $originalName . '_' . time() . '.' . $extension;
        return $file->storeAs('uploads', $newName, 'public');
    }
}
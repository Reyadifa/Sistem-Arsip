<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoris = Kategori::when($search, function ($query) use ($search) {
            return $query->where('nama_kategori', 'like', '%' . $search . '%');
        })->paginate(12)->appends(request()->query());
        
        return view('kategori.index', compact('search', 'kategoris'));
    }



    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_kategori' => 'required',
    ]);

    // Cek apakah kategori dengan nama yang sama sudah ada
    $existingKategori = Kategori::where('nama_kategori', $request->nama_kategori)->first();
    if ($existingKategori) {
        return redirect()->back()->withErrors(['nama_kategori' => 'Kategori dengan nama ini sudah ada.'])->withInput();
    }

    // Simpan kategori baru
    Kategori::create($request->all());

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
}

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required',
        ]);

           // Cek apakah kategori dengan nama yang sama sudah ada
    $existingKategori = Kategori::where('nama_kategori', $request->nama_kategori)->first();
    if ($existingKategori) {
        return redirect()->back()->withErrors(['nama_kategori' => 'Kategori dengan nama ini sudah ada.'])->withInput();
    }

        // Update kategori
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id_kategori)
    {
        // Temukan kategori
        $kategori = Kategori::findOrFail($id_kategori);
        Arsip::where('id_kategori', $id_kategori)->update(['id_kategori' => null]);

        // Hapus kategori
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success_delete', 'Kategori berhasil dihapus dan arsip yang terkait akan di kosongkan kategorinya.');
    }


}
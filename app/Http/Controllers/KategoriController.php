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
        return view('kategori.create'); // Menampilkan form untuk membuat kategori baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        // Simpan kategori baru
        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori')); // Menampilkan form edit
    }

    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        // Update kategori
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id_kategori)
{
    // Temukan kategori
    $kategori = Kategori::findOrFail($id_kategori);
    
    // Perbarui arsip yang terkait dengan mengubah id_kategori menjadi null
    Arsip::where('id_kategori', $id_kategori)->update(['id_kategori' => null]);

    // Hapus kategori
    $kategori->delete();

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus dan arsip terkait tetap ada.');
}


}
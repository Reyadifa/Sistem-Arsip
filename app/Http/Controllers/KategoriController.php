<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // Ambil semua data kategori
        return view('kategori.index', compact('kategoris'));
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

    public function destroy(Kategori $kategori)
    {
        $kategori->delete(); // Hapus kategori

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
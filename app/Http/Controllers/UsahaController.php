<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use Illuminate\Http\Request;
use App\Models\Kategori;

class UsahaController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        $kategoriId = $request->input('kategori');
        $usahas = Usaha::with('kategori')->get();
        return view('usaha.index', compact('usahas', 'kategoris', 'kategoriId'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('usaha.create', compact("kategoris"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'nullable|exists:kategoris,id_kategori',
            'npwp' => 'required|string',
            'nama_usaha' => 'required|string',
            'alamat_usaha' => 'required|string',
            'nama_pemilik' => 'required|string',
            'alamat_pemilik' => 'required|string',
        ]);

        Usaha::create($request->all());

        return redirect()->route('usahas.index')->with('success', 'Data usaha berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $usaha = Usaha::findOrFail($id);
        $kategoris = Kategori::all();
        return view('usaha.edit', compact('usaha', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'nullable|exists:kategoris,id_kategori',
            'npwp' => 'required|string',
            'nama_usaha' => 'required|string',
            'alamat_usaha' => 'required|string',
            'nama_pemilik' => 'required|string',
            'alamat_pemilik' => 'required|string',
        ]);

        $usaha = Usaha::findOrFail($id);
        $usaha->update($request->all());

        return redirect()->route('usahas.index')->with('success', 'Data usaha berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $usaha = Usaha::findOrFail($id);
        $usaha->delete();

        return redirect()->route('usahas.index')->with('success', 'Data usaha berhasil dihapus.');
    }

    public function show($id)
    {
        $usaha = Usaha::findOrFail($id);
        $kategoris = Kategori::all();
        return view('usaha.show', compact('usaha', 'kategoris'));
    }
}

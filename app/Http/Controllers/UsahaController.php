<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use Illuminate\Http\Request;

class UsahaController extends Controller
{
    public function index()
    {
        $usahas = Usaha::all();
        return view('usaha.index', compact('usahas'));
    }

    public function create()
    {
        return view('usaha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
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
        return view('usaha.edit', compact('usaha'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
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
        return view('usaha.show', compact('usaha'));
    }
}

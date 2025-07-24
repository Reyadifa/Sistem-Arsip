<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use App\Models\Usaha;
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
        $kategoris = Kategori::all();

        $arsips = Arsip::with(['kategori', 'usaha'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('usaha', function ($q) use ($search) {
                    $q->where('npwp', 'like', '%' . $search . '%')
                        ->orWhere('nama_usaha', 'like', '%' . $search . '%')
                        ->orWhere('alamat_usaha', 'like', '%' . $search . '%')
                        ->orWhere('nama_pemilik', 'like', '%' . $search . '%');
                })->orWhere('tahun', 'like', '%' . $search . '%')
                    ->orWhere('bulan', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('tahun', 'desc')
            ->orderByRaw("FIELD(bulan, 'Desember', 'November', 'Oktober', 'September', 'Agustus', 'Juli', 'Juni', 'Mei', 'April', 'Maret', 'Februari', 'Januari') ASC")
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->appends(request()->query());

        return view('arsip.index', compact('arsips', 'search', 'bulan', 'tahun', 'kategoriId', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $usahas = Usaha::all();
        return view('arsip.create', compact('kategoris', 'usahas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usaha_id' => 'required|exists:usahas,id',
            'bulan' => 'required',
            'tahun' => 'required|integer',
            'file' => 'file|mimes:pdf|max:2048',
        ]);

        $arsip = new Arsip();
        $arsip->fill($request->only(['usaha_id', 'bulan', 'tahun']));

        if ($request->hasFile('file')) {
            $arsip->file_path = $this->storeFile($request->file('file'));
        }

        $arsip->save();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function edit(Arsip $arsip)
    {
        $kategoris = Kategori::all();
        $usahas = Usaha::all();
        return view('arsip.edit', compact('arsip', 'kategoris', 'usahas'));
    }

    public function update(Request $request, Arsip $arsip)
    {
        $request->validate([
            'usaha_id' => 'required|exists:usahas,id',
            'bulan' => 'required',
            'tahun' => 'required|integer',
            'file' => 'file|mimes:pdf|max:2048',
        ]);

        $arsip->fill($request->only(['usaha_id', 'bulan', 'tahun']));

        if ($request->hasFile('file')) {
            if ($arsip->file_path) {
                Storage::disk('public')->delete($arsip->file_path);
            }
            $arsip->file_path = $this->storeFile($request->file('file'));
        }

        $arsip->save();
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy(Arsip $arsip)
    {
        $arsip->delete();
        return redirect()->route('arsip.index')->with('success_delete', 'Arsip berhasil dihapus.');
    }

    public function show(Arsip $arsip)
    {
        $kategori = $arsip->kategori;
        $usaha = $arsip->usaha;
        return view('arsip.show', compact('arsip', 'kategori', 'usaha'));
    }

    private function storeFile($file)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $newName = $originalName . '_' . time() . '.' . $extension;
        return $file->storeAs('uploads', $newName, 'public');
    }

    public function trash()
    {
        $arsips = Arsip::onlyTrashed()->with(['kategori', 'usaha'])->get();
        return view('arsip.trash', compact('arsips'));
    }

    public function restore($id)
    {
        $arsip = Arsip::withTrashed()->findOrFail($id);
        $arsip->restore();
        return redirect()->route('arsip.trash')->with('success', 'Arsip berhasil dipulihkan.');
    }
}

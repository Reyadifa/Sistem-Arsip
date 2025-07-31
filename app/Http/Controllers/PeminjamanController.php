<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Arsip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    public function create()
    {
        $arsips = Arsip::with(['kategori', 'usaha'])->get();

        $arsipsGrouped = [];

        foreach ($arsips as $arsip) {
            $npwp = optional($arsip->usaha)->npwp;
            if (!$npwp) continue;

            $arsipsGrouped[$npwp][] = [
                'id' => $arsip->id,
                'nama_usaha' => optional($arsip->usaha)->nama_usaha,
                'kategori' => [
                    'nama_kategori' => optional($arsip->kategori)->nama_kategori,
                ],
                'bulan' => $arsip->bulan,
                'tahun' => $arsip->tahun,
            ];
        }

        return view('peminjaman.create', compact('arsipsGrouped'));
    }

    public function store(Request $request)
    {
        $rules = [
            'arsip_id' => 'required|exists:arsips,id',
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'nullable|date',
            'status' => 'required|string',
            'nohp' => 'required|string|max:15',
        ];

        if ($request->form_type === 'with_surat') {
            $rules['surat_kuasa'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
        } else {
            $rules['surat_kuasa'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
        }

        $request->validate($rules);

        $arsipDipinjam = Peminjaman::where('arsip_id', $request->arsip_id)
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->exists();

        if ($arsipDipinjam) {
            return back()->withErrors(['arsip_id' => 'Arsip ini sedang dipinjam.'])->withInput();
        }

        $peminjaman = new Peminjaman($request->only([
            'arsip_id',
            'nama_peminjam',
            'keperluan',
            'tgl_minjam',
            'tgl_kembali',
            'status',
            'nohp'
        ]));

        if ($request->hasFile('surat_kuasa')) {
            $file = $request->file('surat_kuasa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat_kuasa', $filename, 'public');
            $peminjaman->surat_kuasa = $path;
        }

        $arsip = Arsip::find($request->arsip_id);
        $peminjaman->file_arsip = $arsip->file_path ?? null;

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $peminjamans = Peminjaman::with(['arsip.kategori', 'arsip.usaha'])
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_peminjam', 'like', "%$search%")
                        ->orWhere('keperluan', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('nohp', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10);

        $currentDate = now();
        foreach ($peminjamans as $peminjaman) {
            if ($peminjaman->tgl_kembali && $currentDate->gt($peminjaman->tgl_kembali) && $peminjaman->status === 'Dipinjam') {
                $peminjaman->status = 'Terlambat';
                $peminjaman->save();
            }
        }

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function history(Request $request)
    {
        $search = $request->input('search');

        $peminjamans = Peminjaman::with(['arsip.kategori', 'arsip.usaha'])
            ->where('status', 'Dikembalikan')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_peminjam', 'like', "%$search%")
                        ->orWhere('keperluan', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('nohp', 'like', "%$search%");
                });
            })
            ->paginate(10);

        return view('history.index', compact('peminjamans'));
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $peminjamans = Peminjaman::with(['arsip.kategori', 'arsip.usaha'])
            ->where('status', 'Dikembalikan')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_peminjam', 'like', "%$search%")
                        ->orWhere('keperluan', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('nohp', 'like', "%$search%");
                });
            })
            ->get();

        $pdf = PDF::loadView('history.pdf', compact('peminjamans', 'search'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('history-peminjaman-' . now()->format('Ymd-His') . '.pdf');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('arsip.kategori')->findOrFail($id);
        $arsips = Arsip::with(['kategori', 'usaha'])->get();
        $arsipsGrouped = $arsips->groupBy(fn($arsip) => optional($arsip->usaha)->npwp);

        return view('peminjaman.edit', compact('peminjaman', 'arsipsGrouped'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'arsip_id' => 'required|exists:arsips,id',
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'nullable|date',
            'status' => 'required|string',
            'nohp' => 'required|string|max:15',
            'surat_kuasa' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];

        $request->validate($rules);

        $peminjaman = Peminjaman::findOrFail($id);

        $arsipDipinjam = Peminjaman::where('arsip_id', $request->arsip_id)
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->where('id', '!=', $id)
            ->exists();

        if ($arsipDipinjam) {
            return back()->withErrors(['arsip_id' => 'Arsip ini sedang dipinjam.'])->withInput();
        }

        $peminjaman->fill($request->only([
            'arsip_id',
            'nama_peminjam',
            'keperluan',
            'tgl_minjam',
            'tgl_kembali',
            'status',
            'nohp'
        ]));

        if ($request->has('hapus_surat_kuasa') && $peminjaman->surat_kuasa) {
            Storage::disk('public')->delete($peminjaman->surat_kuasa);
            $peminjaman->surat_kuasa = null;
        } elseif ($request->hasFile('surat_kuasa')) {
            if ($peminjaman->surat_kuasa) {
                Storage::disk('public')->delete($peminjaman->surat_kuasa);
            }
            $file = $request->file('surat_kuasa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat_kuasa', $filename, 'public');
            $peminjaman->surat_kuasa = $path;
        }

        $arsip = Arsip::find($request->arsip_id);
        $peminjaman->file_arsip = $arsip->file_path ?? null;
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['arsip.kategori', 'arsip.usaha'])->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->surat_kuasa && Storage::disk('public')->exists($peminjaman->surat_kuasa)) {
            Storage::disk('public')->delete($peminjaman->surat_kuasa);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success_delete', 'Data peminjaman berhasil dihapus.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Arsip berhasil dikembalikan.');
    }
}

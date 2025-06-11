<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Arsip;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    // Controller method yang diperlukan (hanya perlu create dan store)

    public function create()
    {
        $arsips = Arsip::with('kategori')->get(); // Ambil semua arsip tanpa filter
        $arsipsGrouped = $arsips->groupBy('npwp'); // Kelompokkan berdasarkan NPWP jika perlu
        return view('peminjaman.create', compact('arsipsGrouped'));
    }

    public function store(Request $request)
    {
        // Validasi dengan surat kuasa opsional berdasarkan pilihan form
        $rules = [
            'arsip_id' => 'required|exists:arsips,id',
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'nullable|date',
            'status' => 'required|string',
            'nohp' => 'required|string|max:15',
        ];

        // Tambahkan validasi surat kuasa jika dipilih "dengan surat kuasa"
        if ($request->has('form_type') && $request->form_type === 'with_surat') {
            $rules['surat_kuasa'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
        } else {
            $rules['surat_kuasa'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
        }

        $request->validate($rules);

        // Periksa apakah arsip sudah dipinjam atau terlambat dikembalikan
        $arsipDipinjam = Peminjaman::where('arsip_id', $request->arsip_id)
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->exists();

        if ($arsipDipinjam) {
            // Notifikasi arsip sudah dipinjam, tetap di halaman create
            return redirect()->back()->withErrors(['arsip_id' => 'Arsip ini sedang dipinjam atau belum dikembalikan.'])->withInput();
        }

        // Simpan data peminjaman jika arsip tersedia
        $peminjaman = new Peminjaman();
        $peminjaman->arsip_id = $request->arsip_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->tgl_minjam = $request->tgl_minjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->status = $request->status;
        $peminjaman->nohp = $request->nohp;

        // Handle upload surat kuasa - Perbaikan logika
        if ($request->hasFile('surat_kuasa')) {
            $file = $request->file('surat_kuasa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat_kuasa', $filename, 'public');
            $peminjaman->surat_kuasa = $path;
        }

        // Ambil file arsip berdasarkan arsip_id
        $arsip = Arsip::find($request->arsip_id);
        if ($arsip) {
            $peminjaman->file_arsip = $arsip->file_path;
        }

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function index(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->input('search');

        //filter pencarian dan status
        $peminjamans = Peminjaman::query()
            ->whereIn('status', ['Dipinjam', 'Terlambat']) // Filter status
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_peminjam', 'like', "%{$search}%")
                        ->orWhere('keperluan', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('nohp', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $currentDate = now();
        foreach ($peminjamans as $peminjaman) {
            if ($peminjaman->tgl_kembali && $currentDate->greaterThan($peminjaman->tgl_kembali) && $peminjaman->status === 'Dipinjam') {
                $peminjaman->status = 'Terlambat';
                $peminjaman->save();
            }
        }

        // Kirimkan data ke view
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function history(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->input('search');

        // Query peminjaman dengan filter pencarian dan status
        $peminjamans = Peminjaman::query()
            ->where('status', 'Dikembalikan') // Filter status
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_peminjam', 'like', "%{$search}%")
                        ->orWhere('keperluan', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('nohp', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        // Kirimkan data ke view
        return view('history.index', compact('peminjamans'));
    }

    public function exportPdf(Request $request)
    {
        // Ambil query pencarian dari request (jika ada)
        $search = $request->input('search');

        // Query peminjaman dengan filter pencarian dan status (tanpa pagination untuk PDF)
        $peminjamans = Peminjaman::query()
            ->where('status', 'Dikembalikan')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_peminjam', 'like', "%{$search}%")
                        ->orWhere('keperluan', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('nohp', 'like', "%{$search}%");
                });
            })
            ->with(['arsip.kategori']) // Eager loading untuk performa
            ->get();

        // Load view untuk PDF
        $pdf = PDF::loadView('history.pdf', compact('peminjamans', 'search'));

        // Set paper orientation dan size
        $pdf->setPaper('A4', 'landscape');

        // Generate filename dengan timestamp
        $filename = 'history-peminjaman-' . date('Y-m-d-H-i-s') . '.pdf';

        // Download PDF
        return $pdf->download($filename);
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('arsip.kategori')->findOrFail($id);

        // Ambil semua arsip dengan kategori dan kelompokkan berdasarkan NPWP
        $arsips = Arsip::with('kategori')->get();
        $arsipsGrouped = $arsips->groupBy('npwp');

        return view('peminjaman.edit', compact('peminjaman', 'arsipsGrouped'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dengan surat kuasa opsional berdasarkan pilihan form
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

        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Periksa apakah arsip sudah dipinjam oleh peminjaman lain (selain yang sedang diedit)
        $arsipDipinjam = Peminjaman::where('arsip_id', $request->arsip_id)
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->where('id', '!=', $id) // Exclude peminjaman yang sedang diedit
            ->exists();

        if ($arsipDipinjam) {
            return redirect()->back()->withErrors(['arsip_id' => 'Arsip ini sedang dipinjam atau belum dikembalikan.'])->withInput();
        }

        // Update data peminjaman
        $peminjaman->arsip_id = $request->arsip_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->tgl_minjam = $request->tgl_minjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->status = $request->status;
        $peminjaman->nohp = $request->nohp;

        // Handle upload surat kuasa - Konsisten dengan create
        if ($request->has('hapus_surat_kuasa') && $request->hapus_surat_kuasa) {
            // Hapus file lama jika ada
            if ($peminjaman->surat_kuasa && Storage::disk('public')->exists($peminjaman->surat_kuasa)) {
                Storage::disk('public')->delete($peminjaman->surat_kuasa);
            }
            $peminjaman->surat_kuasa = null;
        } elseif ($request->hasFile('surat_kuasa')) {
            // Hapus file lama jika ada
            if ($peminjaman->surat_kuasa && Storage::disk('public')->exists($peminjaman->surat_kuasa)) {
                Storage::disk('public')->delete($peminjaman->surat_kuasa);
            }

            $file = $request->file('surat_kuasa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat_kuasa', $filename, 'public');
            $peminjaman->surat_kuasa = $path;
        }

        // Update file arsip berdasarkan arsip_id
        $arsip = Arsip::find($request->arsip_id);
        if ($arsip) {
            $peminjaman->file_arsip = $arsip->file_path;
        }

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function show($id)
    {
        // Ambil data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Kirim data ke view
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function destroy($id)
    {
        // Cari data peminjaman berdasarkan id
        $peminjaman = Peminjaman::findOrFail($id);

        // Hapus file surat kuasa jika ada
        if ($peminjaman->surat_kuasa && Storage::disk('public')->exists($peminjaman->surat_kuasa)) {
            Storage::disk('public')->delete($peminjaman->surat_kuasa);
        }

        // Hapus data peminjaman
        $peminjaman->delete();

        // Redirect kembali ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success_delete', 'Data peminjaman berhasil dihapus.');
    }
}

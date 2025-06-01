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
    public function create()
    {
        $arsips = Arsip::with('kategori')->get(); // Ambil semua arsip tanpa filter
        $arsipsGrouped = $arsips->groupBy('npwp'); // Kelompokkan berdasarkan NPWP jika perlu
        return view('peminjaman.create', compact('arsipsGrouped'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'arsip_id' => 'required|exists:arsips,id',
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'nullable|date',
            'status' => 'required|string',
            'nohp' => 'required|string|max:15',
            // Perbaikan: Gunakan konsisten 'file' untuk semua jenis file yang diizinkan
            'surat_kuasa' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

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
        $peminjaman = Peminjaman::findOrFail($id);

        // Ambil semua arsip dan kelompokkan berdasarkan NPWP
        $arsips = Arsip::all();
        $arsipsGrouped = $arsips->groupBy('npwp'); // Mengelompokkan arsip berdasarkan NPWP

        // Kirimkan ke view
        return view('peminjaman.edit', compact('peminjaman', 'arsipsGrouped', 'arsips'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input - Perbaikan: gunakan 'file' konsisten
        $request->validate([
            'npwp' => 'required|string', // Validasi npwp
            'arsip_id' => 'required|integer', // Validasi arsip_id
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'status' => 'required|string',
            'nohp' => 'required|string|max:15',
            // Perbaikan: Gunakan 'file' bukan 'image' agar konsisten dengan store()
            'surat_kuasa' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Cari arsip berdasarkan npwp yang dipilih
        $arsip = Arsip::where('npwp', $request->npwp)->first();

        // Jika arsip tidak ditemukan, kembalikan error
        if (!$arsip) {
            return redirect()->back()->withErrors(['npwp' => 'NPWP tidak ditemukan dalam arsip.']);
        }

        // Handle upload surat kuasa baru
        if ($request->hasFile('surat_kuasa')) {
            // Hapus file lama jika ada
            if ($peminjaman->surat_kuasa && Storage::disk('public')->exists($peminjaman->surat_kuasa)) {
                Storage::disk('public')->delete($peminjaman->surat_kuasa);
            }

            $file = $request->file('surat_kuasa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat_kuasa', $filename, 'public');
            $surat_kuasa = $path;
        } else {
            $surat_kuasa = $peminjaman->surat_kuasa; // Pertahankan file lama
        }

        // Perbarui data peminjaman
        $peminjaman->update([
            'arsip_id' => $request->arsip_id, // Gunakan arsip_id yang dipilih
            'nama_peminjam' => $request->nama_peminjam,
            'keperluan' => $request->keperluan,
            'tgl_minjam' => $request->tgl_minjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => $request->status,
            'nohp' => $request->nohp,
            'surat_kuasa' => $surat_kuasa,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
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

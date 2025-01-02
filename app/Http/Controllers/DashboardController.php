<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $kategoriCount = Kategori::count();
        $arsipCount = Arsip::count();

        // Ambil tahun dari request atau gunakan tahun sekarang sebagai default
        $year = request()->get('year', date('Y'));

        // Ambil data arsip per bulan untuk tahun yang dipilih
        $monthlyData = Arsip::select('bulan', DB::raw('COUNT(*) as count'))
            ->where('tahun', $year)
            ->groupBy('bulan')
            ->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
            ->get();

        // Mapping bulan ke angka
        $data = [];
        $bulanMapping = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6,
            'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];

        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = 0; // Inisialisasi data per bulan
        }

        foreach ($monthlyData as $item) {
            $bulanNumber = $bulanMapping[$item->bulan];
            $data[$bulanNumber] = $item->count;
        }

        // Ambil daftar tahun untuk dropdown
        $years = Arsip::select('tahun')->distinct()->orderBy('tahun', 'desc')->get();

        return view('dashboard.dashboard', compact('userCount', 'kategoriCount', 'arsipCount', 'data', 'year', 'years'));
    }
}
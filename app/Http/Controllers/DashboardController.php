<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $kategoriCount = Kategori::count();
        $arsipCount = Arsip::count();

        return view('dashboard.dashboard', compact('userCount', 'kategoriCount', 'arsipCount'));
    }
}
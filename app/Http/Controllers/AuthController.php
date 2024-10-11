<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Ganti dengan nama view login Anda
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Login berhasil, redirect ke halaman index pengguna
            return redirect()->route('users.index'); // Ganti dengan rute setelah login
        }

        // Login gagal
        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
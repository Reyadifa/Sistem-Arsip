<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Replace with your actual login view
    }

    public function login(Request $request)
{
    $request->validate([
        'nama_user' => 'required|string',  // Memastikan nama_user ada dan berupa string
        'password' => 'required|string',   // Memastikan password ada dan berupa string
    ]);

    if (Auth::attempt(['nama_user' => $request->nama_user, 'password' => $request->password])) {
        return redirect()->intended('/dashboard');
    }

    return redirect()->back()->withErrors([
        'nama_user' => 'Username atau password salah.',
    ]);
}


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
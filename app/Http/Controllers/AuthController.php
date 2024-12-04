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
            'email' => 'required|email',
            'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
            }

            return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
            ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
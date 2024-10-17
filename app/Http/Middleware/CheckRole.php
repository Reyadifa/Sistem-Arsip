<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Pastikan user sudah login
        if (Auth::check()) {
            $user = Auth::user();
            Log::info('User Role: ' . $user->role);
            Log::info('Middleware CheckRole diakses dengan role: ' . $role);

            // Admin (role = 1) bisa akses ke semua route yang diizinkan untuk 'admin' dan 'user'
            if ($user->role == 1 && ($role === 'admin' || $role === 'user')) {
                return $next($request);
            }

            // User biasa (role = 2) hanya bisa akses route yang diizinkan untuk 'user'
            if ($user->role == 2 && $role === 'user') {
                return $next($request);
            }
        }

        // Jika tidak ada akses, berikan respon 403 Forbidden
        return response()->json(['message' => 'Forbidden: Anda tidak memiliki akses ke halaman ini.'], 403);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    protected $roleMap = [
        1 => 'pendataan',
        2 => 'pelayanan',
        3 => 'pengarsipan',
    ];

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        
        // Pastikan user memiliki role
        if (!$user->role) {
            abort(403, 'Forbidden: Role tidak ditemukan.');
        }

        Log::info('User role ID: ' . $user->role);
        Log::info('Roles yang diizinkan: ' . implode(', ', $roles));

        // Dapatkan nama role user berdasarkan ID role
        $userRoleName = $this->roleMap[$user->role] ?? null;
        
        Log::info('User role name: ' . ($userRoleName ?? 'tidak ditemukan'));

        // Cek apakah role user valid dan termasuk dalam roles yang diizinkan
        if (!$userRoleName) {
            abort(403, 'Forbidden: Role tidak valid.');
        }

        if (!in_array($userRoleName, $roles)) {
            abort(403, 'Forbidden: Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
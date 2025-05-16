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
    if (!Auth::check()) {
        abort(403, 'Forbidden: Anda tidak memiliki akses ke halaman ini.');
    }

    $user = Auth::user();
    Log::info('User role: ' . $user->role);
    Log::info('Middleware cek role: ' . implode(',', $roles));

    // Dapatkan nama role user
    $userRoleName = $this->roleMap[$user->role] ?? null;
    
    // Cek apakah role user termasuk dalam roles yang diizinkan
    if (!$userRoleName || !in_array($userRoleName, $roles)) {
        abort(403, 'Forbidden: Anda tidak memiliki akses ke halaman ini.');
    }

    return $next($request);
}

}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    protected $roleMap = [
        1 => 'pendataan',
        2 => 'pelayanan',
        3 => 'pengarsipan',
    ];

   public function handle(Request $request, Closure $next, $role)
{
    if (!Auth::check()) {
        abort(403, 'Forbidden: Anda tidak memiliki akses ke halaman ini.');
    }

    $user = Auth::user();
    \Log::info('User role: ' . $user->role);
    \Log::info('Middleware cek role: ' . $role);

    if (!isset($this->roleMap[$user->role]) || $this->roleMap[$user->role] !== $role) {
        abort(403, 'Forbidden: Anda tidak memiliki akses ke halaman ini.');
    }

    return $next($request);
}

}

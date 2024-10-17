<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Cek role user
            if ($role === 'admin' && $user->role == 1) {
                return $next($request);
            } elseif ($role === 'user' && $user->role == 2) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Forbidden: Anda tidak memiliki akses ke halaman ini.'], 403);
    }
}
<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        // Cek apakah user memiliki role yang sesuai
        if (Auth::user()->role !== $role) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $status): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('failed', 'Silakan login terlebih dahulu!');
        }

        // Cek apakah role user sesuai
        if (Auth::user()->status !== $status) {
            return redirect('/')->with('failed', 'Anda tidak memiliki akses ke halaman ini!');
        }

        return $next($request);
    }
}
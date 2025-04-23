<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class StaffProduksiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil data pengguna dari sesi
        $user = session('user');

        // Cek apakah data user ada
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'Unauthorized, please log in.']);
        }

        if ($user['role'] === 'StaffProduksi' || $user['role'] === 'Admin') {
            return $next($request);
        }
        
        if ($request->is('/staffProduksi') && $user['role'] !== 'StaffProduksi') {
            return redirect()->withErrors(['message' => 'Unauthorized, only Admins can access this page.']);
        }

        // Jika role tidak dikenal, redirect ke login
        return redirect('/login')->withErrors(['message' => 'Unauthorized, please log in as Admin or StaffProduksi.']);
    }
}

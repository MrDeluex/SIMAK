<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil data pengguna dari sesi
        $user = session('user');

        // Cek apakah data user ada
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'Unauthorized, please log in.']);
        }
        
        
        if ($user['role'] === 'Staff' || $user['role'] === 'Admin') {
            return $next($request);
        }
        

        // Cek apakah pengguna mencoba mengakses halaman /Staff
        if ($request->is('/staff') && $user['role'] !== 'Staff') {
            return redirect()->back()->withErrors(['message' => 'Unauthorized, only Staffs can access this page.']);
        }

        // Jika role tidak dikenal, redirect ke login
        return redirect('/login')->withErrors(['message' => 'Unauthorized, please log in']);
    }
}

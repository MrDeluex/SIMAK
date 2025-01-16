<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{

    // Ambil data pengguna dari sesi
    $user = session('user');


    // Cek apakah data user ada dan role sesuai
    if (!$user || $user['role'] !== 'Admin') {
        return redirect('/login')->withErrors(['message' => 'Unauthorized, please log in as Admin.']);
    }

    return $next($request);
}
}
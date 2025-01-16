<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login API
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Data login
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // URL API eksternal
        $url = 'http://localhost:8080/api/login';

        // Kirim request ke API
        $response = Http::post($url, $data);
        
        if ($response->successful()) {
            $responseData = $response->json();
    
            // Simpan token dan data user ke sesi
            session(['api_token' => $responseData['data']['token']]);
            session(['user' => $responseData['data']['user']]);
    
            // Ambil role pengguna dari response API
            $role = $responseData['data']['user']['role'];
            // Redirect berdasarkan role
            if ($role === 'Admin') {
                return redirect('/admin')->with('success', 'Login berhasil sebagai Admin!');
            } elseif ($role === 'Karyawan') {
                return redirect('/karyawan')->with('success', 'Login berhasil sebagai Karyawan!');
            }
        }

        // Jika login gagal
        return back()->withErrors(['login_error' => 'Login gagal, periksa email dan password.']);
    }

    public function logout(Request $request)
    {
        // Hapus token dari sesi
        $request->session()->forget('api_token');
        $request->session()->forget('user');  // Opsional: Hapus data user dari sesi
    
        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}

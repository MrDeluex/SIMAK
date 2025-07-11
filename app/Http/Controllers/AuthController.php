<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        $user = session('user');
        
        if($user == null) {
            return view('auth.login');
        } 

        // Periksa dan arahkan berdasarkan role pengguna
        elseif ($user['role'] === 'Admin') {
            return redirect('/admin');
        } elseif ($user['role'] === 'StaffProduksi') {
            return redirect('/staffProduksi');
        } elseif ($user['role'] === 'StaffAdministrasi') {
            return redirect('/staffAdministrasi');
        } else {
            return redirect('/login')->with('error', 'Role tidak dikenali. Silakan login kembali.');
        }
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
        $url = 'https://backend-simak.trihech.my.id/api/login';
        
        // Kirim request ke API
        $response = Http::post($url, $data);
        
        if ($response->successful()) {
            $responseData = $response->json();
            
            // Simpan token dan data user ke sesi
            session(['api_token' => $responseData['data']['token']]);
            session(['user' => $responseData['data']['user']]);
    
            // Ambil role pengguna dari response API
            $role = $responseData['data']['user']['role'];
            
            session()->flash('login_success', 'Selamat datang, ' . $responseData['data']['user']['nama_lengkap'] . '!');

            // Redirect berdasarkan role
            if ($role === 'Admin') {
                return redirect('/admin')->with('success', 'Login berhasil sebagai Admin!');
            } elseif ($role === 'Karyawan') {
                return redirect('/karyawan')->with('success', 'Login berhasil sebagai Karyawan!');
            } elseif ($role === 'Staff') {
                return redirect('/staff')->with('success', 'Login berhasil sebagai Staff!');
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

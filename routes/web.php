<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataTables;
use App\Http\Controllers\AuthController;

Route::get('/', function () { return view('index'); });
Route::get('/home', function () { return view('home'); });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password/no_handphone', function () {return view('auth.noTelfon');});
Route::get('/forgot-password/email', function () {return view('auth.email');});

Route::get('/change_password', function () {return view('auth.change_password');});


Route::get('/percobaan', function () {
    return view('percobaan'); // Mengarahkan ke file percobaan.blade.php
});

Route::get('/data', [DataTables::class, 'index']);
Route::get('/data/{id}', [DataTables::class, 'show']);

Route::middleware(['admin'])->group(function () {
    
    Route::get('/admin', function () { return view('admin.dashboard'); })->name('admin');
    Route::get('/admin/profile', function () { return view('admin.profile'); });

    Route::get('/admin/upah', function () { return view('admin.upah.index'); });
    Route::get('/admin/upah/create', function () { return view('admin.upah.create'); });
    Route::get('/admin/upah/edit', function () { return view('admin.upah.edit'); });
    
    Route::get('/admin/users', function () { return view('admin.users.index'); });
    Route::get('/admin/users/create', function () { return view('admin.users.create'); });
    Route::get('/admin/users/edit', function () { return view('admin.users.edit'); });
    
    Route::get('/admin/karyawan', function () { return view('admin.karyawan.index'); });
    Route::get('/admin/karyawan/create', function () { return view('admin.karyawan.create'); });
    Route::get('/admin/karyawan/edit', function () { return view('admin.karyawan.edit'); });
    
    Route::get('/admin/barang', function () { return view('admin.barang.index'); });
    Route::get('/admin/barang/create', function () { return view('admin.barang.create'); });
    Route::get('/admin/barang/edit', function () { return view('admin.barang.edit'); });

    Route::get('/admin/stock', function () { return view('admin.stock.index'); });
    
    Route::get('/admin/kategori', function () { return view('admin.kategori.index'); });
    Route::get('/admin/kategori/create', function () { return view('admin.kategori.create'); });
    Route::get('/admin/kategori/edit', function () { return view('admin.kategori.edit'); });
    
    Route::get('/admin/harian', function () { return view('admin.barang_harian.index'); });
    Route::get('/admin/harian/create', function () { return view('admin.barang_harian.create'); });
    Route::get('/admin/harian/edit', function () { return view('admin.barang_harian.edit'); });
    
    Route::get('/admin/kategori', function () { return view('admin.kategori.index'); });
    Route::get('/admin/kategori/create', function () { return view('admin.kategori.create'); });
    Route::get('/admin/kategori/edit', function () { return view('admin.kategori.edit'); });
    
    Route::get('/admin/activity', function () { return view('admin.log.index'); });

});

Route::middleware(['staffProduksi'])->group(function () {
    
    Route::get('/staffProduksi', function () { return view('produksi.dashboard'); });
    Route::get('/staffProduksi/profile', function () { return view('produksi.profile'); });
    
    Route::get('/staffProduksi/upah', function () { return view('produksi.upah.index'); });

    Route::get('/staffProduksi/barang', function () { return view('produksi.barang.index'); });
   
    Route::get('/staffProduksi/barangHarian', function () { return view('produksi.barangHarian.index'); });
});

Route::middleware(['staffAdministrasi'])->group(function () {
    
    Route::get('/staffAdministrasi', function () { return view('administrasi.dashboard'); })->name('staffAdministrasi');
    Route::get('/staffAdministrasi/profile', function () { return view('administrasi.profile'); });

    Route::get('/staffAdministrasi/upah', function () { return view('administrasi.upah.index'); });
    Route::get('/staffAdministrasi/upah/create', function () { return view('administrasi.upah.create'); });
    Route::get('/staffAdministrasi/upah/edit', function () { return view('administrasi.upah.edit'); });
    
    Route::get('/staffAdministrasi/users', function () { return view('administrasi.users.index'); });
    Route::get('/staffAdministrasi/users/create', function () { return view('administrasi.users.create'); });
    Route::get('/staffAdministrasi/users/edit', function () { return view('administrasi.users.edit'); });
    
    Route::get('/staffAdministrasi/karyawan', function () { return view('administrasi.karyawan.index'); });
    Route::get('/staffAdministrasi/karyawan/create', function () { return view('administrasi.karyawan.create'); });
    Route::get('/staffAdministrasi/karyawan/edit', function () { return view('administrasi.karyawan.edit'); });
    
    Route::get('/staffAdministrasi/barang', function () { return view('administrasi.barang.index'); });
    Route::get('/staffAdministrasi/barang/create', function () { return view('administrasi.barang.create'); });
    Route::get('/staffAdministrasi/barang/edit', function () { return view('administrasi.barang.edit'); });

    Route::get('/staffAdministrasi/stock', function () { return view('administrasi.stock.index'); });
    
    Route::get('/staffAdministrasi/kategori', function () { return view('administrasi.kategori.index'); });
    Route::get('/staffAdministrasi/kategori/create', function () { return view('administrasi.kategori.create'); });
    Route::get('/staffAdministrasi/kategori/edit', function () { return view('administrasi.kategori.edit'); });
    
    Route::get('/staffAdministrasi/harian', function () { return view('administrasi.barang_harian.index'); });
    Route::get('/staffAdministrasi/harian/create', function () { return view('administrasi.barang_harian.create'); });
    Route::get('/staffAdministrasi/harian/edit', function () { return view('administrasi.barang_harian.edit'); });
    
    Route::get('/staffAdministrasi/kategori', function () { return view('administrasi.kategori.index'); });
    Route::get('/staffAdministrasi/kategori/create', function () { return view('administrasi.kategori.create'); });
    Route::get('/staffAdministrasi/kategori/edit', function () { return view('administrasi.kategori.edit'); });
    
});

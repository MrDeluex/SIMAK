<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataTables;
use App\Http\Controllers\AuthController;

Route::get('/', function () { return view('index'); });
Route::get('/home', function () { return view('home'); });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    
    Route::get('/admin/kategori', function () { return view('admin.kategori.index'); });
    Route::get('/admin/kategori/create', function () { return view('admin.kategori.create'); });
    Route::get('/admin/kategori/edit', function () { return view('admin.kategori.edit'); });
    
    Route::get('/admin/harian', function () { return view('admin.barang_harian.index'); });
    Route::get('/admin/harian/create', function () { return view('admin.barang_harian.create'); });
    Route::get('/admin/harian/edit', function () { return view('admin.barang_harian.edit'); });
    
    Route::get('/admin/kategori', function () { return view('admin.kategori.index'); });
    Route::get('/admin/kategori/create', function () { return view('admin.kategori.create'); });
    Route::get('/admin/kategori/edit', function () { return view('admin.kategori.edit'); });

});

Route::middleware(['StaffProduksi'])->group(function () {
    
    Route::get('/StaffProduksi', function () { return view('karyawan.dashboard'); });
    Route::get('/StaffProduksi/profile', function () { return view('karyawan.profile'); });
    
});

Route::middleware(['StaffAdministrasi'])->group(function () {
    
    Route::get('/StaffAdministrasi', function () { return view('staff.dashboard'); });
    Route::get('/StaffAdministrasi/profile', function () { return view('staff.profile'); });
    
});

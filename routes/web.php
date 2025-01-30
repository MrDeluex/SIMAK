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
    Route::get('/admin/users/create', function () { return view('admin.users.create'); });
    Route::get('/admin/users/edit', function () { return view('admin.users.edit'); });

});

Route::middleware(['karyawan'])->group(function () {
    
    Route::get('/karyawan', function () { return view('karyawan.dashboard'); });
    Route::get('/karyawan/profile', function () { return view('karyawan.profile'); });
    
});

Route::middleware(['staff'])->group(function () {
    
    Route::get('/staff', function () { return view('staff.dashboard'); });
    Route::get('/staff/profile', function () { return view('staff.profile'); });
    
});

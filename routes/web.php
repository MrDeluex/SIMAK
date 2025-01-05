<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataTables;

Route::get('/percobaan', function () {
    return view('percobaan'); // Mengarahkan ke file percobaan.blade.php
});

Route::get('/data', [DataTables::class, 'index']);
Route::get('/data/{id}', [DataTables::class, 'show']);


Route::get('/', function () { return view('index'); });
Route::get('/home', function () { return view('home'); });

Route::get('/login', function () { return view('login'); });

Route::get('/admin', function () { return view('admin.dashboard'); });
Route::get('/admin/profile', function () { return view('admin.profile'); });

Route::get('/admin/upah', function () { return view('admin.upah.index'); });
Route::get('/admin/upah/create', function () { return view('admin.upah.create'); });
Route::get('/admin/upah/edit', function () { return view('admin.upah.edit'); });


Route::get('/karyawan', function () { return view('karyawan.dashboard'); });
Route::get('/karyawan/profile', function () { return view('karyawan.profile'); });



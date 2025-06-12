<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstansiController;

/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('user.pengaduan.index');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('user.pengaduan.store');
    Route::get('/dashboard', [PengaduanController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/pengaduan/{id}', [PengaduanController::class, 'show'])->name('user.pengaduan.show'); // 👁️ Detail pengaduan user
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pengaduan/{id}', [AdminController::class, 'show'])->name('admin.pengaduan.show');
    Route::delete('/admin/pengaduan/{id}', [AdminController::class, 'destroy'])->name('admin.pengaduan.destroy');
});

/*
|--------------------------------------------------------------------------
| Instansi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:instansi'])->group(function () {
    Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.dashboard');

    Route::get('/instansi/pengaduan/{id}', [InstansiController::class, 'show'])->name('instansi.pengaduan.show');
    Route::get('/instansi/pengaduan/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.pengaduan.edit');
    Route::put('/instansi/pengaduan/{id}', [InstansiController::class, 'update'])->name('instansi.pengaduan.update');
    Route::delete('/instansi/pengaduan/{id}', [InstansiController::class, 'destroy'])->name('instansi.pengaduan.destroy');

    Route::post('/instansi/pengaduan/{id}', [InstansiController::class, 'tanggapi'])->name('instansi.pengaduan.tanggapi');
    Route::post('/instansi/pengaduan/{id}/selesai', [InstansiController::class, 'setSelesai'])->name('instansi.pengaduan.selesai');
});

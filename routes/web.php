<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AdminProgressController;
use App\Http\Controllers\Admin\AdminPekerjaanController;
use App\Http\Controllers\User\PekerjaanController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\RiwayatLaporanController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// Halaman dashboard admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Halaman laporan untuk admin
Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
Route::get('/admin/laporan/{pekerjaan}/detail', [LaporanController::class, 'show'])->name('admin.laporan.detail');
Route::get('/admin/progress/{id}/dokumentasi', [AdminProgressController::class, 'showDokumentasi'])->name('admin.progress.dokumentasi');

// Pekerjaan Admin
Route::get('/admin/pekerjaan', [AdminPekerjaanController::class, 'index'])->name('admin.pekerjaan.index');


// Manajemen user di admin
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/admin/register', [UserController::class, 'create'])->name('admin.registerUser');
Route::post('/admin/register', [UserController::class, 'store'])->name('admin.registerUser.store');



// Dashboard User
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

// User routes
Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.post');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// Dashboard user (harus login)
Route::get('/user/dashboard', function () {
    // Menampilkan dashboard user
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');


// Route untuk halaman pekerjaan user
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/pekerjaan', [PekerjaanController::class, 'index'])->name('user.pekerjaan.index');
    Route::post('/user/pekerjaan/store', [PekerjaanController::class, 'store'])->name('user.pekerjaan.store');
    Route::get('user/pekerjaan/{id}/progress/{progress}/edit', [PekerjaanController::class, 'editProgress'])
    ->name('user.pekerjaan.edit-progress');
    Route::put('/user/pekerjaan/{id}/progress/{progress}', [PekerjaanController::class, 'updateProgress'])->name('user.pekerjaan.update-progress');
    Route::get('/user/pekerjaan/progress-lapangan', [PekerjaanController::class, 'progressLapangan'])->name('user.pekerjaan.progress-lapangan');
    Route::get('/user/pekerjaan/{id}/tambah-progress', [PekerjaanController::class, 'tambahProgressForm'])->name('user.pekerjaan.tambah-progress');
    Route::post('/user/pekerjaan/{id}/tambah-progress', [PekerjaanController::class, 'tambahProgress'])->name('user.pekerjaan.tambah-progress');
    Route::post('/user/pekerjaan/{id}/simpan-progress', [PekerjaanController::class, 'simpanProgress'])->name('user.pekerjaan.simpan-progress');
    Route::get('/user/pekerjaan/{id}/progress', [PekerjaanController::class, 'detailProgress'])->name('user.pekerjaan.detail-progress');
    Route::put('/user/pekerjaan/{id}/selesai', [PekerjaanController::class, 'markAsSelesai'])->name('user.pekerjaan.selesai');
    Route::get('/user/riwayat-laporan', [RiwayatLaporanController::class, 'index'])->name('user.pekerjaan.riwayat-laporan');
    Route::get('/user/riwayat-laporan/{id}', [RiwayatLaporanController::class, 'detail'])->name('user.pekerjaan.riwayat-laporan.detail');


});

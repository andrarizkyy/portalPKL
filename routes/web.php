<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\LandingController;
use App\Models\Jurusan;

// ──── PUBLIC ────
Route::get('/', [LandingController::class , 'index'])->name('landing');

// ──── AUTH (Google Only for Siswa/Dudi) ────
Route::get('/login', [AuthController::class , 'showLogin'])->name('login');
Route::get('/register', [AuthController::class , 'showRegister'])->name('register');
Route::post('/login', [AuthController::class , 'login']);
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

// Google OAuth with Role (Registration) or without Role (Login)
Route::get('/auth/google/redirect/{role?}', [AuthController::class , 'redirectToGoogle'])
    ->where('role', 'siswa|dudi')
    ->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class , 'handleGoogleCallback']);


// ──── API (jurusan by sekolah) ────
Route::get('/api/jurusan/{sekolah}', function ($sekolahId) {
    return response()->json(Jurusan::where('sekolah_id', $sekolahId)->get());
});

// ══════════════════════════════════════
//  ADMIN ROUTES
// ══════════════════════════════════════
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class , 'dashboard'])->name('dashboard');

    // Sekolah
    Route::get('/sekolah', [AdminController::class , 'sekolahIndex'])->name('sekolah.index');
    Route::get('/sekolah/create', [AdminController::class , 'sekolahCreate'])->name('sekolah.create');
    Route::post('/sekolah', [AdminController::class , 'sekolahStore'])->name('sekolah.store');
    Route::get('/sekolah/{sekolah}/edit', [AdminController::class , 'sekolahEdit'])->name('sekolah.edit');
    Route::put('/sekolah/{sekolah}', [AdminController::class , 'sekolahUpdate'])->name('sekolah.update');
    Route::delete('/sekolah/{sekolah}', [AdminController::class , 'sekolahDestroy'])->name('sekolah.destroy');

    // Jurusan
    Route::get('/jurusan', [AdminController::class , 'jurusanIndex'])->name('jurusan.index');
    Route::get('/jurusan/create', [AdminController::class , 'jurusanCreate'])->name('jurusan.create');
    Route::post('/jurusan', [AdminController::class , 'jurusanStore'])->name('jurusan.store');
    Route::get('/jurusan/{jurusan}/edit', [AdminController::class , 'jurusanEdit'])->name('jurusan.edit');
    Route::put('/jurusan/{jurusan}', [AdminController::class , 'jurusanUpdate'])->name('jurusan.update');
    Route::delete('/jurusan/{jurusan}', [AdminController::class , 'jurusanDestroy'])->name('jurusan.destroy');

    // Industry
    Route::get('/industry', [AdminController::class , 'industryIndex'])->name('industry.index');
    Route::get('/industry/create', [AdminController::class , 'industryCreate'])->name('industry.create');
    Route::post('/industry', [AdminController::class , 'industryStore'])->name('industry.store');
    Route::get('/industry/{industry}/edit', [AdminController::class , 'industryEdit'])->name('industry.edit');
    Route::put('/industry/{industry}', [AdminController::class , 'industryUpdate'])->name('industry.update');
    Route::delete('/industry/{industry}', [AdminController::class , 'industryDestroy'])->name('industry.destroy');

    // DUDI Verifikasi
    Route::get('/dudi', [AdminController::class , 'dudiIndex'])->name('dudi.index');
    Route::get('/dudi/{dudi}', [AdminController::class , 'dudiShow'])->name('dudi.show');
    Route::put('/dudi/{dudi}/status', [AdminController::class , 'dudiUpdateStatus'])->name('dudi.updateStatus');

    // Siswa Data
    Route::get('/siswa', [AdminController::class , 'siswaIndex'])->name('siswa.index');
});

// ══════════════════════════════════════
//  SISWA ROUTES
// ══════════════════════════════════════
Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->name('siswa.')->group(function () {
    Route::get('/', [SiswaController::class , 'dashboard'])->name('dashboard');
    Route::get('/profil', [SiswaController::class , 'profil'])->name('profil');
    Route::post('/profil', [SiswaController::class , 'profilUpdate'])->name('profil.update');

    Route::middleware('profile.complete')->group(function () {
            Route::get('/lowongan', [SiswaController::class , 'lowonganIndex'])->name('lowongan.index');
            Route::get('/lowongan/{lowongan}', [SiswaController::class , 'lowonganShow'])->name('lowongan.show');
            Route::get('/lowongan/{lowongan}/posisi/{posisi}/lamar', [SiswaController::class , 'lamar'])->name('lamar');
            Route::post('/posisi/{posisi}/lamar', [SiswaController::class , 'lamarStore'])->name('lamar.store');
            Route::get('/lamaran', [SiswaController::class , 'lamaranIndex'])->name('lamaran.index');
        }
        );
    });

// ══════════════════════════════════════
//  DUDI ROUTES
// ══════════════════════════════════════



Route::prefix('dudi')->middleware(['auth', 'role:dudi'])->name('dudi.')->group(function () {
    Route::get('/', [DudiController::class , 'dashboard'])->name('dashboard');
    Route::get('/profil', [DudiController::class , 'profil'])->name('profil');
    Route::post('/profil', [DudiController::class , 'profilUpdate'])->name('profil.update');

    Route::middleware('profile.complete')->group(function () {
            Route::get('/lowongan', [DudiController::class , 'lowonganIndex'])->name('lowongan.index');
            Route::get('/lowongan/create', [DudiController::class , 'lowonganCreate'])->name('lowongan.create');
            Route::post('/lowongan', [DudiController::class , 'lowonganStore'])->name('lowongan.store');
            Route::get('/lowongan/{lowongan}', [DudiController::class , 'lowonganShow'])->name('lowongan.show');
            Route::get('/lowongan/{lowongan}/edit', [DudiController::class , 'lowonganEdit'])->name('lowongan.edit');
            Route::put('/lowongan/{lowongan}', [DudiController::class , 'lowonganUpdate'])->name('lowongan.update');
            Route::delete('/lowongan/{lowongan}', [DudiController::class , 'lowonganDestroy'])->name('lowongan.destroy');

            Route::get('/lamaran', [DudiController::class , 'lamaranIndex'])->name('lamaran.index');
            Route::get('/lamaran/{lamaran}', [DudiController::class , 'lamaranShow'])->name('lamaran.show');
            Route::put('/lamaran/{lamaran}/status', [DudiController::class , 'lamaranUpdateStatus'])->name('lamaran.updateStatus');
        }
        );
    });

    // ══════════════════════════════════════
//  PUBLIC PERUSAHAAN ROUTES
// ══════════════════════════════════════
Route::get('/perusahaan', [DudiController::class, 'indexPublic'])
    ->name('perusahaan.index');

Route::get('/perusahaan/{dudi}', [DudiController::class, 'showPublic'])
    ->name('perusahaan.show');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\homeController;
use App\Http\Controllers\programController;
use App\Http\Controllers\instrukturController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdmin\JenisMicrocredentialController;
use App\Http\Controllers\SuperAdmin\SemesterController;
use App\Http\Controllers\SuperAdmin\ProgramMicrocredentialController;
use App\Http\Controllers\tugasController;
use App\Models\JenisMicrocredential;
use App\Models\Semester;
use App\Models\ProgramMicrocredential;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    // 1. CEK GUEST (PENCEGAHAN DOUBLE LOGIN)
    // Jika ada user yang sudah terlanjur login mencoba mengakses halaman '/login' lagi,
    // kita cegah mereka melihat form login dan langsung kita 'lemparkan' kembali ke dasbornya.
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'peserta') return redirect('/peserta/dasbor');
        if ($role === 'instruktur') return redirect('/instruktur/dasbor');
        if ($role === 'admin_microcredential') return redirect('/admin/dasbor');
        if ($role === 'super_admin') return redirect('/super-admin/dasbor');
    }

    // 2. TAMPILKAN FORM
    // Jika belum login sama sekali, barulah kita tampilkan halaman form login.
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('register');
})->name('register.process');

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [homeController::class, 'index'])->name('index');
Route::get('/tentang', fn() => view('tentang'))->name('tentang');
Route::get('/instruktur', [instrukturController::class, 'instruktur'])->name('instruktur');

/*
|--------------------------------------------------------------------------
| PROGRAM
|--------------------------------------------------------------------------
*/
Route::prefix('program')->name('program.')->group(function () {
    Route::get('/', [programController::class, 'index'])->name('index');
    Route::get('/saya', fn() => view('programsaya'))->name('saya');
    Route::get('/pendaftaran', fn() => view('pendaftaran'))->name('pendaftaran');
});

/*
|--------------------------------------------------------------------------
| INSTRUKTUR
|--------------------------------------------------------------------------
*/

Route::prefix('instruktur')->name('instruktur.')->middleware('check.session:instruktur')->group(function () {


    Route::get('/dasbor', fn() => view('instruktur.dasbor'))->name('dasbor');
    Route::get('/profil', fn() => view('instruktur.profil'))->name('profil');

    Route::get('/kursus', fn() => view('instruktur.kursus'))->name('kursus');
    Route::get('/detail-kursus', fn() => view('instruktur.detail-kursus'))->name('detail-kursus');

    Route::get('/tugas', function () {
        $tugas = config('tugas');
        return view('instruktur.tugas', compact('tugas'));
    })->name('tugas');

    Route::get('/tugas-detail', fn() => view('instruktur.tugas-detail'))->name('tugas-detail');
    Route::get('/tugas-kumpul', fn() => view('instruktur.tugas-kumpul'))->name('tugas-kumpul');

    Route::get('/kuis-mulai', function () {
        $kuis = config('kuis');
        return view('instruktur.kuis-mulai', compact('kuis'));
    })->name('kuis-mulai');

    Route::get('/kuis-detail', function () {
        $kuis = config('kuis');
        return view('instruktur.kuis-detail', compact('kuis'));
    })->name('kuis-detail');
    Route::get('/upload-materi', fn() => view('instruktur.upload-materi'))->name('upload-materi');
});

/*
|--------------------------------------------------------------------------
| PESERTA
|--------------------------------------------------------------------------
*/
Route::prefix('peserta')->name('peserta.')->middleware('check.session:peserta')->group(function () {

    Route::get('/dasbor', fn() => view('peserta.dasbor'))->name('dasbor');

    Route::get('/kursus', fn() => view('peserta.kursus'))->name('kursus');
    Route::get('/detail-kursus', fn() => view('peserta.detail-kursus'))->name('detail-kursus');
    Route::get('/profil', fn() => view('peserta.profil'))->name('profil');

    Route::get('/tugas', [tugasController::class, 'tugas'])->name('tugas');
    Route::get('/tugas-detail', fn() => view('peserta.tugas-detail'))->name('tugas-detail');
    Route::get('/tugas-kumpul', fn() => view('peserta.tugas-kumpul'))->name('tugas-kumpul');

    Route::get('/kuis-mulai', [tugasController::class, 'kuis'])->name('kuis-mulai');
    Route::get('/kuis-detail', [tugasController::class, 'kuisDetail'])->name('kuis-detail');

    Route::get('/nilai-detail', fn() => view('peserta.nilai-detail'))->name('nilai-detail');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('super-admin')->name('superAdmin.')->middleware('check.session:super_admin')->group(function () {
    Route::get('/dasbor', function () {
        $jenisMicrocredentials = JenisMicrocredential::orderBy('dibuat_pada', 'desc')->limit(2)->get();
        $semesters = Semester::orderBy('dibuat_pada', 'desc')->limit(2)->get();
        $programs = ProgramMicrocredential::with(['jenisMicrocredential', 'semester'])->orderBy('dibuat_pada', 'desc')->limit(2)->get();
        return view('superAdmin.dasbor', compact('jenisMicrocredentials', 'semesters', 'programs'));
    })->name('dasbor');
    Route::get('/profil', fn() => view('superAdmin.profil'))->name('profil');
    Route::get('/program', fn() => view('superAdmin.program'))->name('program');
    Route::get('/program/edit', fn() => view('superAdmin.programEdit'))->name('program.edit');

    // New pages added from remote
    Route::get('/admin-instruktur', fn() => view('superAdmin.adminInstruktur'))->name('adminInstruktur');

    // Jenis Microcredential CRUD
    Route::get('/jenis-microcredential', [JenisMicrocredentialController::class, 'index'])->name('jenisMicrocredential');
    Route::post('/jenis-microcredential', [JenisMicrocredentialController::class, 'store'])->name('jenisMicrocredential.store');
    Route::put('/jenis-microcredential/{id}', [JenisMicrocredentialController::class, 'update'])->name('jenisMicrocredential.update');
    Route::delete('/jenis-microcredential/{id}', [JenisMicrocredentialController::class, 'destroy'])->name('jenisMicrocredential.destroy');

    Route::get('/periode-akademik', fn() => view('superAdmin.periodeAkademik'))->name('periodeAkademik');

    // Program Microcredential CRUD
    Route::get('/program-microcredential', [ProgramMicrocredentialController::class, 'index'])->name('programMicrocredential');
    Route::post('/program-microcredential', [ProgramMicrocredentialController::class, 'store'])->name('programMicrocredential.store');
    Route::put('/program-microcredential/{id}', [ProgramMicrocredentialController::class, 'update'])->name('programMicrocredential.update');
    Route::delete('/program-microcredential/{id}', [ProgramMicrocredentialController::class, 'destroy'])->name('programMicrocredential.destroy');

    // Semester CRUD
    Route::get('/semester', [SemesterController::class, 'index'])->name('semester');
    Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
    Route::put('/semester/{id}', [SemesterController::class, 'update'])->name('semester.update');
    Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN MICRO
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('check.session:admin_microcredential')->group(function () {
    Route::get('/dasbor', fn() => view('admin.dasbor'))->name('dasbor');
    Route::get('/profil', fn() => view('admin.profil'))->name('profil');

    Route::get('/program', fn() => view('admin.programIndex', ['programs' => []]))->name('program.index');
    Route::get('/program/create', fn() => view('admin.programCreate'))->name('program.create');
    Route::get('/program/{id}/edit', fn() => view('admin.programEdit'))->name('program.edit');

    Route::get('/program/{id}/kursus', fn() => view('admin.kursusIndex'))->name('program.kursus.index');
    Route::get('/program/{id}/kursus/create', fn() => view('admin.kursusCreate'))->name('program.kursus.create');
    Route::get('/program/{id}/kursus/{course}/edit', fn() => view('admin.kursusEdit'))->name('program.kursus.edit');

    Route::get('/verifikasi', fn() => view('admin.verifikasiIndex', ['registrations' => []]))->name('verifikasi.index');
});

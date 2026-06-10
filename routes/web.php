<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\instructorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\tugasController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('register');
})->name('register.process');

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', [homeController::class, 'index'])->name('index');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/instructors', [instructorsController::class, 'instructors'])->name('instructors');

/*
|--------------------------------------------------------------------------
| COURSES
|--------------------------------------------------------------------------
*/
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [coursesController::class, 'index'])->name('index');
    Route::get('/my', fn() => view('myCourses'))->name('my');
    Route::get('/enroll', fn() => view('enroll'))->name('enroll');
});

/*
|--------------------------------------------------------------------------
| INSTRUCTORS
|---------------------------------------------------------------------
-----
*/

Route::prefix('instructor')->name('instructor.')->group(function () {


    Route::get('/dashboard', fn() => view('instructor.dashboard'))->name('dashboard');
    Route::get('/profile', fn() => view('instructor.profile'))->name('profile');

    Route::get('/courses', fn() => view('instructor.courses'))->name('courses');
    Route::get('/course', fn() => view('instructor.course'))->name('course');

    Route::get('/tugas', function () {
        $tugas = config('tugas');
        return view('instructor.tugas', compact('tugas'));
    })->name('tugas');

    //(commented buat pelajaran, abaikan aja) Route::get('/tugas', [tugasController::class, 'tugas'])->name('tugas');
    Route::get('/tugas-detail', fn() => view('instructor.tugas-detail'))->name('tugas-detail');
    Route::get('/tugas-kumpul', fn() => view('instructor.tugas-kumpul'))->name('tugas-kumpul');

    Route::get('/kuis-mulai', [tugasController::class, 'kuis'])->name('kuis-mulai');
    Route::get('/kuis-detail', [tugasController::class, 'kuisDetail'])->name('kuis-detail');
    Route::get('/upload-materi', fn() => view('instructor.upload-materi'))->name('upload-materi');
});

/*
|--------------------------------------------------------------------------
| PESERTA
|--------------------------------------------------------------------------
*/
Route::prefix('peserta')->name('peserta.')->group(function () {

    Route::get('/dashboard', fn() => view('peserta.dashboard'))->name('dashboard');

    Route::get('/courses', fn() => view('peserta.courses'))->name('courses');
    Route::get('/course-detail', fn() => view('peserta.course-detail'))->name('course-detail');
    Route::get('/profile', fn() => view('peserta.profile'))->name('profile');

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
Route::prefix('super-admin')->name('superAdmin.')->group(function () {
    Route::get('/dashboard', fn() => view('superAdmin.dashboard'))->name('dashboard');
    Route::get('/profile', fn() => view('superAdmin.profile'))->name('profile');

    // Halaman tabel kelola data
    Route::get('/jenis-microcredential', fn() => view('superAdmin.jenisMicrocredential'))->name('jenisMicrocredential.index');
    Route::get('/admin-instruktur', fn() => view('superAdmin.adminInstruktur'))->name('adminInstruktur.index');
    Route::get('/semester', fn() => view('superAdmin.semester'))->name('semester.index');
    Route::get('/periode-akademik', fn() => view('superAdmin.periodeAkademik'))->name('periodeAkademik.index');
    Route::get('/program', fn() => view('superAdmin.programMicrocredential'))->name('program.index');
    Route::get('/program/create', fn() => view('superAdmin.programCreate'))->name('program.create');
});

/*
|--------------------------------------------------------------------------
| ADMIN MICRO
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/profile', fn() => view('admin.profile'))->name('profile');

    Route::get('/program', fn() => view('admin.programIndex', ['programs' => []]))->name('program.index');
    Route::get('/program/create', fn() => view('admin.programCreate'))->name('program.create');
    Route::get('/program/{id}/edit', fn() => view('admin.programEdit'))->name('program.edit');

    Route::get('/program/{id}/kursus', fn() => view('admin.kursusIndex'))->name('program.kursus.index');
    Route::get('/program/{id}/kursus/create', fn() => view('admin.kursusCreate'))->name('program.kursus.create');
    Route::get('/program/{id}/kursus/{course}/edit', fn() => view('admin.kursusEdit'))->name('program.kursus.edit');

    Route::get('/verifikasi', fn() => view('admin.verifikasiIndex', ['registrations' => []]))->name('verifikasi.index');
});

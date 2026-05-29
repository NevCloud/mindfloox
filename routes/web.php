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
Route::get('/register', function () {
    return view('register'); // Ganti dengan nama file view Anda
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
    Route::get('/my', fn() => view('mycourses'))->name('my');
    Route::get('/enroll', fn() => view('enroll'))->name('enroll');
});

/*
|--------------------------------------------------------------------------
| INSTRUCTORS
|---------------------------------------------------------------------
-----
*/

Route::prefix('instructor')->middleware(['auth', 'role:instruktur'])->group(function () {

    Route::get('/dashboard', fn() => view('instructor.dashboard'))->name('dashboard');

    Route::get('/courses', fn() => view('instructor.courses'))->name('courses');
    Route::get('/course', fn() => view('instructor.course'))->name('course');

    Route::get('/tugas', [tugasController::class, 'tugas'])->name('tugas');
    Route::get('/tugas-detail', fn() => view('instructor.tugas-detail'))->name('tugas-detail');
    Route::get('/tugas-kumpul', fn() => view('instructor.tugas-kumpul'))->name('tugas-kumpul');

    Route::get('/kuis-mulai', [tugasController::class, 'kuis'])->name('kuis-mulai');
    Route::get('/kuis-detail', [tugasController::class, 'kuis-detail'])->name('kuis-detail');
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
    Route::get('/kuis-detail', [tugasController::class, 'kuis-detail'])->name('kuis-detail');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('super-admin')->name('superAdmin.')->group(function () {
    Route::get('/dashboard', fn() => view('superAdmin.dashboard'))->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
});

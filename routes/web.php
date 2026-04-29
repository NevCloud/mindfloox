<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\instructorsController;
use App\Http\Controllers\authController;
use App\Http\Controllers\tugasController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [authController::class, 'login'])->name('login.process');

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', [homeController::class, 'index'])->name('index');
Route::get('/about', fn() => view('about'))->name('about');

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
|--------------------------------------------------------------------------
*/
Route::get('/instructors', [instructorsController::class, 'instructors'])
    ->name('instructors');

/*
|--------------------------------------------------------------------------
| PESERTA
|--------------------------------------------------------------------------
*/
Route::prefix('peserta')->name('peserta.')->group(function () {

    Route::get('/dashboard', fn() => view('peserta.dashboard'))->name('dashboard');

    Route::get('/courses', fn() => view('peserta.courses'))->name('courses');
    Route::get('/course-detail', fn() => view('peserta.courseDetail'))->name('courseDetail');

    Route::get('/tugas', [tugasController::class, 'tugas'])->name('tugas');
    Route::get('/tugas-detail', fn() => view('peserta.tugasDetail'))->name('tugasDetail');
    Route::get('/tugas-kumpul', fn() => view('peserta.tugasKumpul'))->name('tugasKumpul');

    Route::get('/kuis-mulai', [tugasController::class, 'kuis'])->name('kuisMulai');
    Route::get('/kuis-detail', [tugasController::class, 'kuisDetail'])->name('kuisDetail');
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

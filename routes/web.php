<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\instructorsController;
use App\Http\Controllers\authController;
use App\Http\Controllers\tugasController;

Route::post('/login', [authController::class, 'login'])->name('login.process');

// Halaman Utama
Route::get('/', [homeController::class, 'index'])->name('index');

// Halaman Otentikasi
Route::get('/login', function () {
    return view('login');
})->name('login');

// Halaman Informasi & Statis
Route::get('/about', function () {
    return view('about');
})->name('about');

// Halaman Kursus
Route::get('/courses', [coursesController::class, 'index'])->name('courses');

Route::get('/my-courses', function () {
    return view('mycourses');
})->name('courses.my');

Route::get('/enroll', function () {
    return view('enroll');
})->name('courses.enroll');

// Halaman instruktur
Route::get('/instructors', [instructorsController::class, 'instructors'
])->name('instructors');

// Halaman Peserta
Route::get('/peserta/dashboard', function () {
    return view('peserta.dashboard');
})->name('peserta.dashboard');

Route::get('/peserta/courses', function () {
    return view('peserta.courses');
})->name('peserta.courses');

Route::get('/peserta/tugas',  [tugasController::class, 'index'
])->name('peserta.tugas');

Route::get('/peserta/tugasDetail', function () {
    return view('peserta.tugasDetail');
})->name('peserta.tugasDetail');

Route::get('/peserta/tugasKumpul', function () {
    return view('peserta.tugasKumpul');
})->name('peserta.tugasKumpul');

Route::get('/dashboard/instruktur', function () {
    return view('instruktur.dashboard');
})->name('dashboard.instruktur');

Route::get('/dashboard/admin', function () {
    return view('admin.dashboard');
})->name('dashboard.admin');

Route::get('/dashboard/superadmin', function () {
    return view('superadmin.dashboard');
})->name('dashboard.superadmin');

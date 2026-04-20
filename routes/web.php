<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', function () {
    return view('login');
})->name('login');

// Halaman About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Halaman Course
Route::get('/course', function () {
    return view('courses');
})->name('courses');

route::get('/myCourses', function () {
    return view('myCourses');
})->name('mycourses');

// Halaman Instructors
use App\Http\Controllers\instructorsController;
Route::get('/instructors', [instructorsController::class, 'instructors'])->name('instructors');

// Halaman Enroll
Route::get('/enroll', function () {
    return view('enroll');
})->name('enroll');

// Halaman Courses
use App\Http\Controllers\coursesController;
Route::get('/courses', [coursesController::class, 'courses'])->name('courses');

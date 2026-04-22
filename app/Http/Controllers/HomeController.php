<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $courses = config('courses');

        $instructors = config('instructors');

        $categories = config('categories');
        
        return view('index', compact('courses', 'instructors', 'categories'));
    }
}

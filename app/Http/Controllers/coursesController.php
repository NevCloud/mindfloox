<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class coursesController extends Controller
{
    public function index()
    {
        $courses = config('courses');

        return view('courses', compact('courses'));
    }
}

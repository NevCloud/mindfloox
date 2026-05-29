<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class instructorsController extends Controller
{
    public function instructors()
    {
        $instructors = config('instructors');

        return view('instructors', compact('instructors'));
    }
}

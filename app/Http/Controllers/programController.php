<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class programController extends Controller
{
    public function index()
    {
        $program = config('program');

        return view('program', compact('program'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tugasController extends Controller
{
    public function index()
    {
        $tugas = config('tugas');

        return view('peserta.tugas', compact('tugas'));
    }
}

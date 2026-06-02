<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tugasController extends Controller
{
    public function tugas()
    {
        $tugas = config('tugas');

        return view('peserta.tugas', compact('tugas'));
    }

    public function kuis()
    {
        $kuis = config('kuis');

        return view('peserta.kuis-mulai', compact('kuis'));
    }

    public function kuisDetail()
    {
        $kuis = config('kuis');

        return view('peserta.kuis-detail', compact('kuis'));
    }
}

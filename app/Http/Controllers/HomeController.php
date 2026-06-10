<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $program = config('program');

        $instruktur = config('instruktur');

        $kategori = config('kategori');
        
        return view('index', compact('program', 'instruktur', 'kategori'));
    }
}

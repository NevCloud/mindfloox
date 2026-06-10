<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class instrukturController extends Controller
{
    public function instruktur()
    {
        $instruktur = config('instruktur');

        return view('instruktur', compact('instruktur'));
    }
}

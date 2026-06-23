<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Instruktur;

class instrukturController extends Controller
{
    public function instruktur()
    {
        $instruktur = Instruktur::with('pengguna')->withCount('kursusInstruktur')
            ->get()
            ->sortByDesc('total_peserta');

        // We can paginate collection or just pass it all if small.
        // For simplicity, we just pass all for now.
        return view('instruktur', compact('instruktur'));
    }
}

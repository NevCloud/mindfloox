<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Instruktur;
use App\Models\ProgramMicrocredential;
use App\Models\JenisMicrocredential;

class homeController extends Controller
{
    public function index()
    {
        // Get top 4 instructors ordered by total_peserta
        $instruktur = Instruktur::with('pengguna')->withCount('kursusInstruktur')
            ->get()
            ->sortByDesc('total_peserta')
            ->take(4);

        // Get programs
        $program = ProgramMicrocredential::with(['adminMicrocredential.pengguna', 'jenisMicrocredential'])
            ->withCount(['pendaftaran' => function ($query) {
                $query->where('status', 'diterima');
            }])
            ->take(6)
            ->get();

        // Get categories
        $kategori = JenisMicrocredential::withCount('programMicrocredential')->get();
        
        return view('index', compact('program', 'instruktur', 'kategori'));
    }
}

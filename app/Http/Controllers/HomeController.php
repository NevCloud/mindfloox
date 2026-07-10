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
        // Get programs
        $program = ProgramMicrocredential::with([
            'adminMicrocredential.pengguna',
            'jenisMicrocredential',
            'kursus.ulasanKursus'
        ])
            ->withCount([
                'pendaftaran' => function ($query) {
                    $query->where('status', 'diterima');
                }
            ])
            ->take(3)
            ->get()
            ->map(function ($prog) {

                $ratings = $prog->kursus
                    ->flatMap(function ($kursus) {
                        return $kursus->ulasanKursus;
                    })
                    ->pluck('rating_kursus');

                $prog->rating = $ratings->isNotEmpty()
                    ? round($ratings->avg(), 1)
                    : 0;

                $prog->jumlah_ulasan = $ratings->count();

                return $prog;
            });

        // Get categories
        $kategori = JenisMicrocredential::has('programMicrocredential')->withCount('programMicrocredential')->get();

        return view('index', compact('program', 'instruktur', 'kategori'));
    }
}

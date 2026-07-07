<?php

namespace App\Http\Controllers;

use App\Models\ProgramMicrocredential;
use Illuminate\Support\Facades\DB;

class RatingProgramController extends Controller
{
    public function index()
    {
        $programs = ProgramMicrocredential::with([
            'kursus.ulasanKursus'
        ])
            ->withCount('pendaftaran')
            ->get()
            ->map(function ($program) {

                $ratings = $program->kursus
                    ->flatMap(function ($kursus) {
                        return $kursus->ulasanKursus;
                    })
                    ->pluck('rating_kursus')
                    ->filter();

                $program->rating = $ratings->count()
                    ? round($ratings->avg(), 1)
                    : 0;

                $program->jumlah_ulasan = $ratings->count();

                return $program;
            });


        return view('nama-view', compact('programs'));
    }
}

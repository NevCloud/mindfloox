<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\KursusInstruktur;
use App\Models\SesiKuis;
use App\Models\Tugas;
use App\Models\Kuis;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DasborController extends Controller
{
    public function index()
    {
        $instruktur = Auth::user()->instruktur;
        $kursusDiajar = $instruktur->kursus()->count();

        $kiIds = KursusInstruktur::where('id_instruktur', $instruktur->id)->pluck('id')->toArray();
        
        $programIds = \App\Models\Kursus::whereHas('kursusInstruktur', function($q) use ($instruktur) {
            $q->where('id_instruktur', $instruktur->id);
        })->pluck('id_program_microcredential')->unique();

        $totalPeserta = Pendaftaran::whereIn('id_program_microcredential', $programIds)
            ->where('status', 'diterima')
            ->count();

        $menungguPenilaianTugas = JawabanTugas::whereHas('tugas', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds))
            ->whereDoesntHave('pendaftaran.nilaiTugas', fn($q) => $q->whereColumn('nilai_tugas.id_tugas', 'jawaban_tugas.id_tugas'))
            ->count();

        $menungguPenilaianKuis = SesiKuis::whereHas('kuis', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds))
            ->where('status', 'selesai')
            ->whereDoesntHave('nilaiKuis')
            ->count();

        $menungguPenilaian = $menungguPenilaianTugas + $menungguPenilaianKuis;

        $terlambatEvaluasiTugas = JawabanTugas::whereHas('tugas', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds)->where('batas_waktu', '<', now()))
            ->whereDoesntHave('pendaftaran.nilaiTugas', fn($q) => $q->whereColumn('nilai_tugas.id_tugas', 'jawaban_tugas.id_tugas'))
            ->count();

        $terlambatEvaluasiKuis = SesiKuis::whereHas('kuis', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds)->where('batas_waktu', '<', now()))
            ->where('status', 'selesai')
            ->whereDoesntHave('nilaiKuis')
            ->count();

        $terlambatEvaluasi = $terlambatEvaluasiTugas + $terlambatEvaluasiKuis;

        $deadlineTugas = Tugas::whereIn('id_kursus_instruktur', $kiIds)
            ->whereBetween('batas_waktu', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
            
        $deadlineKuis = Kuis::whereIn('id_kursus_instruktur', $kiIds)
            ->whereBetween('batas_waktu', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
            
        $deadlineMingguIni = $deadlineTugas + $deadlineKuis;
            
        $kursusList = $instruktur->kursus()->with('programMicrocredential')->take(4)->get();

        return view('instruktur.dasbor', compact(
            'kursusDiajar', 
            'totalPeserta',
            'menungguPenilaian', 
            'terlambatEvaluasi', 
            'deadlineMingguIni',
            'kursusList',
            'menungguPenilaianTugas'
        ));
    }
}

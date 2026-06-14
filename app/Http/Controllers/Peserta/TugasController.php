<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kursus;
use App\Models\NilaiTugas;
use App\Models\Pendaftaran;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    private function peserta()
    {
        return Auth::user()->peserta;
    }

    public function index()
    {
        $peserta = $this->peserta();

        $pendaftaranList = $peserta->pendaftaran()
            ->where('status', 'diterima')
            ->with('programMicrocredential.kursus')
            ->get();

        $kursusIds = $pendaftaranList
            ->flatMap(fn($p) => $p->programMicrocredential->kursus->pluck('id'))
            ->unique()->values()->toArray();

        $pendaftaranById = $pendaftaranList->keyBy('id_program_microcredential');

        $tugas = Tugas::whereIn('id_kursus', $kursusIds)
            ->with('kursus')
            ->orderBy('batas_waktu')
            ->get();

        $pendaftaranIds = $pendaftaranList->pluck('id')->toArray();

        $jawabanMap = JawabanTugas::whereIn('id_pendaftaran', $pendaftaranIds)
            ->where('status', 'final')
            ->get()
            ->keyBy('id_tugas');

        $nilaiMap = NilaiTugas::whereIn('id_pendaftaran', $pendaftaranIds)
            ->get()
            ->keyBy('id_tugas');

        $tugasList = $tugas->map(function (Tugas $t) use ($pendaftaranList, $jawabanMap, $nilaiMap) {
            $pendaftaran = $pendaftaranList->first(
                fn($p) => $p->programMicrocredential->kursus->contains('id', $t->id_kursus)
            );
            $jawaban = $jawabanMap->get($t->id);
            $nilai   = $nilaiMap->get($t->id);

            return [
                'id'          => $t->id,
                'judul'       => $t->judul,
                'deskripsi'   => $t->deskripsi,
                'kursus'      => $t->kursus->nama,
                'nilai_maks'  => $t->nilai,
                'batas_waktu' => $t->batas_waktu,
                'dikumpulkan' => (bool) $jawaban,
                'disubmit_pada' => $jawaban?->disubmit_pada,
                'nilai'       => $nilai?->nilai_mentah,
                'dinilai_pada'=> $nilai?->dinilai_pada,
            ];
        })->values();

        return view('peserta.tugas', compact('tugasList'));
    }

    private function getPendaftaran(Tugas $tugas): Pendaftaran
    {
        return Pendaftaran::where('id_peserta', $this->peserta()->id)
            ->where('id_program_microcredential', $tugas->kursus->id_program_microcredential)
            ->where('status', 'diterima')
            ->firstOrFail();
    }

    public function show(Tugas $tugas)
    {
        $tugas->load('kursus');
        $pendaftaran = $this->getPendaftaran($tugas);

        $jawaban = JawabanTugas::where('id_pendaftaran', $pendaftaran->id)
            ->where('id_tugas', $tugas->id)
            ->latest('disubmit_pada')
            ->first();

        $nilaiTugas = NilaiTugas::where('id_pendaftaran', $pendaftaran->id)
            ->where('id_tugas', $tugas->id)
            ->first();

        return view('peserta.tugas-kumpul', compact('tugas', 'pendaftaran', 'jawaban', 'nilaiTugas'));
    }

    public function submit(Request $request, Tugas $tugas)
    {
        $request->validate(['file_tugas' => 'required|file|max:20480']);

        $tugas->load('kursus');
        $pendaftaran = $this->getPendaftaran($tugas);

        $path = Storage::disk('public')->putFile('tugas', $request->file('file_tugas'));

        JawabanTugas::updateOrCreate(
            ['id_pendaftaran' => $pendaftaran->id, 'id_tugas' => $tugas->id],
            ['url_file' => $path, 'status' => 'final', 'disubmit_pada' => now()]
        );

        return redirect()->route('peserta.tugas.show', $tugas->id)
            ->with('success', 'Tugas berhasil dikumpulkan!');
    }
}

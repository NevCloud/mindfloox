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
            ->get();

        $kuis = \App\Models\Kuis::whereIn('id_kursus', $kursusIds)
            ->with('kursus')
            ->get();

        $pendaftaranIds = $pendaftaranList->pluck('id')->toArray();

        // Tugas Status
        $jawabanTugasMap = JawabanTugas::whereIn('id_pendaftaran', $pendaftaranIds)
            ->where('status', 'final')
            ->get()
            ->keyBy('id_tugas');

        $nilaiTugasMap = NilaiTugas::whereIn('id_pendaftaran', $pendaftaranIds)
            ->get()
            ->keyBy('id_tugas');

        // Kuis Status
        $sesiKuisList = \App\Models\SesiKuis::whereIn('id_pendaftaran', $pendaftaranIds)
            ->with(['nilaiKuis', 'jawabanKuis'])
            ->get()
            ->keyBy('id_kuis');

        $tugasList = $tugas->map(function (Tugas $t) use ($pendaftaranList, $jawabanTugasMap, $nilaiTugasMap) {
            $jawaban = $jawabanTugasMap->get($t->id);
            $nilai   = $nilaiTugasMap->get($t->id);

            $btnLabel = 'Kumpulkan';
            if ($nilai !== null) {
                $btnLabel = 'Lihat Nilai';
            } elseif ($jawaban) {
                $btnLabel = 'Kumpulkan Ulang';
            }

            return [
                'id'          => $t->id,
                'type'        => 'tugas',
                'judul'       => $t->judul,
                'deskripsi'   => $t->deskripsi,
                'kursus'      => $t->kursus->nama,
                'nilai_maks'  => $t->nilai,
                'batas_waktu' => $t->batas_waktu,
                'dikumpulkan' => (bool) $jawaban,
                'disubmit_pada' => $jawaban?->disubmit_pada,
                'nilai'       => $nilai?->nilai_mentah,
                'dinilai_pada'=> $nilai?->dinilai_pada,
                'url'         => route('peserta.tugas.show', $t->id),
                'btn_label'   => $btnLabel,
            ];
        });

        $kuisList = $kuis->map(function (\App\Models\Kuis $k) use ($sesiKuisList) {
            $sesi = $sesiKuisList->get($k->id);
            $jawabanCount = $sesi ? $sesi->jawabanKuis->count() : 0;
            $nilai = $sesi ? $sesi->nilaiKuis : null;
            
            $dikumpulkan = $nilai !== null || $jawabanCount > 0;

            $btnLabel = 'Kerjakan';
            if ($nilai !== null || $dikumpulkan) {
                $btnLabel = 'Lihat Kuis';
            }

            return [
                'id'          => $k->id,
                'type'        => 'kuis',
                'judul'       => 'Quiz: ' . $k->judul,
                'deskripsi'   => $k->deskripsi,
                'kursus'      => $k->kursus->nama,
                'nilai_maks'  => 100, // assuming kuis is out of 100
                'batas_waktu' => $k->batas_waktu,
                'dikumpulkan' => $dikumpulkan,
                'disubmit_pada' => $sesi?->diselesaikan_pada ?? $sesi?->dimulai_pada,
                'nilai'       => $nilai?->nilai_mentah,
                'dinilai_pada'=> $nilai?->dihitung_pada,
                'url'         => route('peserta.kuis.show', $k->id),
                'btn_label'   => $btnLabel,
            ];
        });

        $gabunganList = $tugasList->concat($kuisList)->sortBy('batas_waktu')->values();

        return view('peserta.tugas', ['tugasList' => $gabunganList]);
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

        $nilaiTugas = NilaiTugas::where('id_pendaftaran', $pendaftaran->id)
            ->where('id_tugas', $tugas->id)
            ->first();

        if ($nilaiTugas) {
            return redirect()->back()->withErrors(['error' => 'Tugas sudah dinilai, tidak bisa mengumpulkan ulang.']);
        }

        $path = Storage::disk('public')->putFile('tugas', $request->file('file_tugas'));

        JawabanTugas::updateOrCreate(
            ['id_pendaftaran' => $pendaftaran->id, 'id_tugas' => $tugas->id],
            ['url_file' => $path, 'status' => 'final', 'disubmit_pada' => now()]
        );

        return redirect()->route('peserta.tugas.show', $tugas->id)
            ->with('success', 'Tugas berhasil dikumpulkan!');
    }
}

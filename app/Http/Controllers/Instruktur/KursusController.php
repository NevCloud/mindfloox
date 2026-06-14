<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\MateriPembelajaran;
use App\Models\Kuis;
use App\Models\Tugas;
use App\Models\Minggu;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    private function instruktur()
    {
        return Auth::user()->instruktur;
    }

    private function getKursusInstruktur(Kursus $kursus): KursusInstruktur
    {
        return KursusInstruktur::where([
            'id_kursus'     => $kursus->id,
            'id_instruktur' => $this->instruktur()->id,
        ])->firstOrFail();
    }

    public function index()
    {
        $instruktur = $this->instruktur();
        $kursus = $instruktur->kursus()->with('programMicrocredential.semester')->get();

        return view('instruktur.kursus', compact('kursus', 'instruktur'));
    }

    public function show(Kursus $kursus)
    {
        $kursusInstruktur = $this->getKursusInstruktur($kursus);

        $mingguIds = MateriPembelajaran::where('id_kursus', $kursus->id)->pluck('id_minggu')
            ->merge(Kuis::where('id_kursus', $kursus->id)->pluck('id_minggu'))
            ->unique()->filter()->values();

        $minggu = Minggu::whereIn('id', $mingguIds)
            ->orderBy('nomor_minggu')
            ->with([
                'materiPembelajaran' => fn($q) => $q->where('id_kursus', $kursus->id)->orderBy('nomor_urut'),
                'kuis'               => fn($q) => $q->where('id_kursus', $kursus->id),
            ])
            ->get();

        $tugas = Tugas::where('id_kursus', $kursus->id)
            ->where('id_kursus_instruktur', $kursusInstruktur->id)
            ->orderBy('dibuat_pada')
            ->get();

        // Transform for Alpine.js consumption
        $weeksJs = $minggu->map(function (Minggu $m) {
            $items = [];

            foreach ($m->materiPembelajaran as $materi) {
                $items[] = [
                    'id'         => $materi->id,
                    'tipe'       => 'materi',
                    'tipe_materi'=> $materi->tipe ?? 'dokumen',
                    'judul'      => $materi->judul,
                    'url_file'   => $materi->url_file,
                    'nomor_urut' => $materi->nomor_urut,
                    'meta1'      => null,
                    'meta2'      => null,
                ];
            }

            foreach ($m->kuis as $k) {
                $items[] = [
                    'id'         => $k->id,
                    'tipe'       => 'kuis',
                    'tipe_materi'=> 'kuis',
                    'judul'      => $k->judul,
                    'url_file'   => null,
                    'nomor_urut' => 9999,
                    'meta1'      => $k->batas_waktu_menit ? $k->batas_waktu_menit . ' Menit' : null,
                    'meta2'      => null,
                ];
            }

            usort($items, fn($a, $b) => $a['nomor_urut'] <=> $b['nomor_urut']);

            return [
                'id'     => $m->id,
                'nomor'  => $m->nomor_minggu,
                'status' => $m->status,
                'open'   => false,
                'items'  => array_values($items),
            ];
        })->values();

        $tugasJs = $tugas->map(fn(Tugas $t) => [
            'id'          => $t->id,
            'judul'       => $t->judul,
            'deskripsi'   => $t->deskripsi,
            'nilai'       => $t->nilai,
            'batas_waktu' => $t->batas_waktu?->format('d M Y H:i'),
        ])->values();

        return view('instruktur.detail-kursus', compact(
            'kursus', 'kursusInstruktur', 'weeksJs', 'tugasJs'
        ));
    }
}

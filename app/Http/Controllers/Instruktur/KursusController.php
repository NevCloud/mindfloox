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

        // Load all weeks for this course (including empty ones)
        $minggu = Minggu::where('id_kursus', $kursus->id)
            ->orderBy('nomor_minggu')
            ->with([
                'materiPembelajaran' => fn($q) => $q->where('id_kursus', $kursus->id)->orderBy('nomor_urut'),
                'kuis'               => fn($q) => $q->where('id_kursus', $kursus->id),
            ])
            ->get();

        // If no weeks exist yet (old courses), create 14 on the fly
        if ($minggu->isEmpty()) {
            for ($i = 1; $i <= 14; $i++) {
                Minggu::create([
                    'id_kursus'    => $kursus->id,
                    'nomor_minggu' => $i,
                    'nama'         => 'Minggu ' . $i,
                    'judul'        => null,
                    'deskripsi'    => 'Materi minggu ke-' . $i,
                    'status'       => $i <= 3 ? 'aktif' : 'nonaktif',
                ]);
            }
            $minggu = Minggu::where('id_kursus', $kursus->id)
                ->orderBy('nomor_minggu')
                ->with([
                    'materiPembelajaran' => fn($q) => $q->where('id_kursus', $kursus->id)->orderBy('nomor_urut'),
                    'kuis'               => fn($q) => $q->where('id_kursus', $kursus->id),
                ])
                ->get();
        }

        $tugas = Tugas::where('id_kursus', $kursus->id)
            ->where('id_kursus_instruktur', $kursusInstruktur->id)
            ->orderBy('dibuat_pada')
            ->get();

        // Transform for Alpine.js consumption
        $weeksJs = $minggu->map(function (Minggu $m) use ($tugas) {
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
                    'nomor_urut' => $k->nomor_urut ?? 999,
                    'meta1'      => $k->batas_waktu_menit ? $k->batas_waktu_menit . ' Menit' : null,
                    'meta2'      => null,
                ];
            }

            $mingguTugas = $tugas->where('id_minggu', $m->id);
            foreach ($mingguTugas as $t) {
                $items[] = [
                    'id'         => $t->id,
                    'tipe'       => 'tugas',
                    'tipe_materi'=> 'tugas',
                    'judul'      => $t->judul,
                    'url_file'   => null,
                    'nomor_urut' => $t->nomor_urut ?? 999,
                    'meta1'      => $t->batas_waktu ? 'Tenggat: ' . $t->batas_waktu->format('d M Y, H:i') : null,
                    'meta2'      => null,
                ];
            }

            usort($items, fn($a, $b) => $a['nomor_urut'] <=> $b['nomor_urut']);

            return [
                'id'        => $m->id,
                'nomor'     => $m->nomor_minggu,
                'judul'     => $m->judul,
                'deskripsi' => $m->deskripsi,
                'status'    => $m->status,
                'open'      => false,
                'items'     => array_values($items),
            ];
        })->values();

        $tugasJs = [];

        return view('instruktur.detail-kursus', compact(
            'kursus', 'kursusInstruktur', 'weeksJs', 'tugasJs'
        ));
    }
}

<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\MateriPembelajaran;
use App\Models\Minggu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MingguController extends Controller
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

    /**
     * Update judul & deskripsi minggu (AJAX).
     */
    public function update(Request $request, Kursus $kursus, Minggu $minggu)
    {
        $this->getKursusInstruktur($kursus);

        $request->validate([
            'judul'     => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $minggu->update($request->only(['judul', 'deskripsi']));

        return response()->json([
            'success' => true,
            'minggu'  => $minggu
        ]);
    }

    /**
     * Reorder materi dalam satu minggu (AJAX).
     * Expects: { items: [{id, tipe, nomor_urut}, ...] }
     */
    public function reorderMateri(Request $request, Kursus $kursus, Minggu $minggu)
    {
        $this->getKursusInstruktur($kursus);

        $request->validate([
            'items'              => 'required|array',
            'items.*.id'         => 'required|integer',
            'items.*.tipe'       => 'required|string|in:materi,kuis,tugas',
            'items.*.nomor_urut' => 'required|integer|min:1',
        ]);

        foreach ($request->items as $item) {
            if ($item['tipe'] === 'materi') {
                MateriPembelajaran::where('id', $item['id'])
                    ->where('id_kursus', $kursus->id)
                    ->update([
                        'nomor_urut' => $item['nomor_urut'],
                        'id_minggu'  => $minggu->id,
                    ]);
            } elseif ($item['tipe'] === 'tugas') {
                \App\Models\Tugas::where('id', $item['id'])
                    ->where('id_kursus', $kursus->id)
                    ->update([
                        'nomor_urut' => $item['nomor_urut'],
                        'id_minggu'  => $minggu->id,
                    ]);
            } elseif ($item['tipe'] === 'kuis') {
                \App\Models\Kuis::where('id', $item['id'])
                    ->where('id_kursus', $kursus->id)
                    ->update([
                        'nomor_urut' => $item['nomor_urut'],
                        'id_minggu'  => $minggu->id,
                    ]);
            }
        }

        return response()->json(['success' => true]);
    }
}

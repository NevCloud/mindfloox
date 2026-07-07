<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pendaftaran;
use App\Models\UlasanKursus;

class RatingKursusController extends Controller
{
    /**
     * Menampilkan halaman ulasan berdasarkan pendaftaran.
     */
    public function create($id)
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with([
            'programMicrocredential.kursus'
        ])->findOrFail($id);

        // Pastikan hanya peserta pemilik pendaftaran yang bisa membuka
        abort_if(
            $pendaftaran->id_peserta != $user->peserta->id,
            403
        );

        // Pastikan pendaftaran diterima
        abort_if(
            $pendaftaran->status !== 'diterima',
            403
        );

        $program = $pendaftaran->programMicrocredential;

        $kursus = $program->kursus;

        return view('peserta.ulasan', compact(
            'pendaftaran',
            'program',
            'kursus'
        ));
    }

    /**
     * Menyimpan ulasan seluruh kursus.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pendaftaran'               => 'required|exists:pendaftaran,id',
            'ulasan'                       => 'required|array',
            'ulasan.*.id_kursus'           => 'required|exists:kursus,id',
            'ulasan.*.rating_kursus'       => 'required|integer|min:1|max:5',
            'ulasan.*.komentar_kursus'     => 'nullable|string|max:1000',
        ], [
            'ulasan.*.rating_kursus.required' => 'Rating wajib dipilih.',
            'ulasan.*.rating_kursus.min'      => 'Minimal 1 bintang.',
            'ulasan.*.rating_kursus.max'      => 'Maksimal 5 bintang.',
        ]);

        $pendaftaran = Pendaftaran::findOrFail(
            $request->id_pendaftaran
        );

        $peserta = Auth::user()->peserta;

        // Pastikan hanya pemilik pendaftaran
        abort_if(
            $pendaftaran->id_peserta != $peserta->id,
            403
        );

        // Pastikan status diterima
        abort_if(
            $pendaftaran->status !== 'diterima',
            403
        );

        foreach ($request->ulasan as $item) {

            UlasanKursus::updateOrCreate(

                [
                    'id_pendaftaran' => $pendaftaran->id,
                    'id_kursus'      => $item['id_kursus'],
                ],

                [
                    'rating_kursus'   => $item['rating_kursus'],
                    'komentar_kursus' => $item['komentar_kursus'] ?? null,
                ]

            );
        }

        return redirect()
            ->route('peserta.profil')
            ->with(
                'success',
                'Terima kasih, seluruh rating berhasil disimpan.'
            );
    }
}

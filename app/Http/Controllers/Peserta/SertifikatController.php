<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\SertifikatKursus;
use App\Models\Pendaftaran;
use App\Models\NilaiKursus;

class SertifikatController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with([
            'programMicrocredential.periodePembelajaran',
            'peserta.pengguna'
        ])->findOrFail($id);

        abort_if(
            $pendaftaran->id_peserta != $user->peserta->id,
            403
        );

        $sertifikat = SertifikatKursus::firstOrCreate(
            [
                'id_pendaftaran' => $pendaftaran->id,
            ],
            [
                'nomor_sertifikat' => 'MC-' . date('Y') . '-' . str_pad($pendaftaran->id, 5, '0', STR_PAD_LEFT),
                'tanggal_terbit' => now(),
            ]
        );

        $program = $pendaftaran->programMicrocredential;

        $nilai = NilaiKursus::with('kursus')
            ->where('id_pendaftaran', $pendaftaran->id)
            ->get();

        $rataRata = round($nilai->avg('nilai_akhir'), 2);
        $this->generateQr(
            $sertifikat,
            $pendaftaran,
            $program
        );
        return view(
            'peserta.sertifikat',
            compact(
                'pendaftaran',
                'program',
                'nilai',
                'rataRata',
                'sertifikat'
            )
        );
    }

    public function download($id)
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with([
            'programMicrocredential',
            'peserta.pengguna',
            'nilaiKursus.kursus',
            'sertifikatKursus'
        ])->findOrFail($id);

        // Pastikan milik peserta yang login
        abort_if(
            $pendaftaran->id_peserta != $user->peserta->id,
            403
        );

        // Ambil / buat data sertifikat
        $sertifikat = SertifikatKursus::firstOrCreate(
            [
                'id_pendaftaran' => $pendaftaran->id,
            ],
            [
                'nomor_sertifikat' => 'MC-' . date('Y') . '-' . str_pad($pendaftaran->id, 5, '0', STR_PAD_LEFT),
                'tanggal_terbit'   => now(),
                'url_file'         => null,
            ]
        );

        $program = $pendaftaran->programMicrocredential;

        $nilai = $pendaftaran->nilaiKursus;

        $rataRata = round(
            $nilai->avg('nilai_akhir'),
            2
        );

        // Jika file sudah pernah dibuat
        if ($sertifikat->url_file && Storage::disk('public')->exists($sertifikat->url_file)) {
            return Storage::disk('public')->download(
                $sertifikat->url_file,
                $sertifikat->nomor_sertifikat . '.pdf'
            );
        }
        $this->generateQr(
            $sertifikat,
            $pendaftaran,
            $program
        );
        // Generate PDF dari blade yang sama
        $pdf = Pdf::loadView('peserta.sertifikat', compact(
            'sertifikat',
            'pendaftaran',
            'program',
            'nilai',
            'rataRata'
        ));

        $pdf->setPaper('a4', 'landscape');

        // Simpan PDF
        $folder = 'sertifikat';
        $namaFile = $sertifikat->nomor_sertifikat . '.pdf';

        Storage::disk('public')->put(
            $folder . '/' . $namaFile,
            $pdf->output()
        );

        // Simpan path ke database
        $sertifikat->update([
            'url_file' => $folder . '/' . $namaFile,
        ]);

        return response()->download(
            storage_path('app/public/' . $sertifikat->url_file)
        );
    }

    private function generateQr($sertifikat, $pendaftaran, $program)
    {
        $folder = public_path('qrcode');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $folder . '/' . $sertifikat->nomor_sertifikat . '.png';

        // Jika QR sudah ada, tidak perlu dibuat lagi
        if (!File::exists($file)) {

            $namaPeserta = $pendaftaran->peserta->pengguna->nama;

            $qrContent =
                "Nama Peserta : {$namaPeserta}\n" .
                "Nomor Sertifikat : {$sertifikat->nomor_sertifikat}\n" .
                "Program : {$program->nama}";

            $url = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($qrContent);

            $image = @file_get_contents($url);

            if ($image !== false) {
                file_put_contents($file, $image);
            }
        }
    }
}

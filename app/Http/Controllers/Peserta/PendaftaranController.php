<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\ProgramMicrocredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    /**
     * Helper: dapatkan model Peserta dari user yang sedang login.
     */
    private function peserta()
    {
        return Auth::user()->peserta;
    }

    /**
     * Menampilkan daftar Program Microcredential yang terbuka untuk pendaftaran.
     * Menampilkan juga status pendaftaran peserta untuk setiap program.
     */
    public function index()
    {
        $peserta = $this->peserta();

        // Ambil semua program yang status pendaftarannya buka
        $programs = ProgramMicrocredential::with(['jenisMicrocredential', 'periodePembelajaran', 'kursus'])
            ->where('status_pendaftaran', 'buka')
            ->orderBy('dibuat_pada', 'desc')
            ->get();

        // Ambil pendaftaran peserta untuk program-program di atas (untuk menampilkan status)
        $existingRegistrations = Pendaftaran::where('id_peserta', $peserta->id)
            ->whereIn('id_program_microcredential', $programs->pluck('id'))
            ->get()
            ->keyBy('id_program_microcredential');

        return view('peserta.program', compact('programs', 'existingRegistrations'));
    }

    /**
     * Menyimpan pendaftaran peserta ke program microcredential tertentu.
     */
    public function store(Request $request, $programId)
    {
        $peserta = $this->peserta();

        $program = ProgramMicrocredential::findOrFail($programId);

        // Cek apakah pendaftaran masih dibuka
        if ($program->status_pendaftaran !== 'buka') {
            return redirect()
                ->route('peserta.pendaftaran.index')
                ->with('error', 'Pendaftaran untuk program "' . $program->nama . '" saat ini ditutup.');
        }

        // Cek apakah peserta sudah pernah mendaftar ke program ini
        $existing = Pendaftaran::where('id_peserta', $peserta->id)
            ->where('id_program_microcredential', $program->id)
            ->first();

        if ($existing) {
            if ($existing->status === 'menunggu') {
                return redirect()
                    ->route('peserta.pendaftaran.index')
                    ->with('error', 'Anda sudah mendaftar ke program "' . $program->nama . '" dan sedang menunggu verifikasi.');
            }

            if ($existing->status === 'diterima') {
                return redirect()
                    ->route('peserta.pendaftaran.index')
                    ->with('error', 'Anda sudah diterima di program "' . $program->nama . '".');
            }

            if ($existing->status === 'ditolak') {
                return redirect()
                    ->route('peserta.pendaftaran.index')
                    ->with('error', 'Pendaftaran Anda ke program "' . $program->nama . '" sebelumnya ditolak. Silakan hubungi admin untuk informasi lebih lanjut.');
            }
        }

        // Buat pendaftaran baru
        Pendaftaran::create([
            'id_peserta'                 => $peserta->id,
            'id_program_microcredential' => $program->id,
            'status'                     => 'menunggu',
            'tanggal_daftar'             => Carbon::now(),
        ]);

        return redirect()
            ->route('peserta.pendaftaran.index')
            ->with('success', 'Pendaftaran ke program "' . $program->nama . '" berhasil dikirim. Silakan menunggu verifikasi dari admin.');
    }

    /**
     * Menampilkan riwayat pendaftaran peserta (semua status).
     */
    public function riwayat()
    {
        $peserta = $this->peserta();

        $registrations = Pendaftaran::with([
            'programMicrocredential.jenisMicrocredential',
            'programMicrocredential.periodePembelajaran',
            'diverifikasiOleh.pengguna',
        ])
            ->where('id_peserta', $peserta->id)
            ->orderBy('tanggal_daftar', 'desc')
            ->get();

        return view('peserta.riwayat', compact('registrations'));
    }
}

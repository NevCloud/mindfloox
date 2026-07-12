<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramMicrocredential;
use App\Models\Pengguna;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProgramPublicController extends Controller
{
    public function show($id)
    {
        $program = ProgramMicrocredential::with(['kursus', 'jenisMicrocredential', 'adminMicrocredential.pengguna'])
            ->findOrFail($id);

        return view('program-detail', compact('program'));
    }

    public function daftar(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna,email',
        ]);

        $program = ProgramMicrocredential::findOrFail($id);

        $now = now();
        $startDate = $program->tanggal_mulai_pendaftaran ? \Carbon\Carbon::parse($program->tanggal_mulai_pendaftaran) : null;
        $endDate = $program->tanggal_akhir_pendaftaran ? \Carbon\Carbon::parse($program->tanggal_akhir_pendaftaran) : null;
        
        $isOpen = false;
        if ($program->status_pendaftaran === 'buka' && $startDate && $endDate) {
            if ($now->between($startDate, $endDate)) {
                $isOpen = true;
            }
        }
        
        if (!$isOpen) {
            $pesan = 'Pendaftaran untuk program ini saat ini sudah ditutup.';
            
            if ($program->status_pendaftaran === 'tutup') {
                $pesan = 'Pendaftaran sedang ditutup, mohon kembali lagi nanti.';
            } elseif ($endDate && $now->gt($endDate)) {
                $pesan = 'Waktu pendaftaran untuk program ini sudah berakhir.';
            } elseif ($startDate && $now->lt($startDate)) {
                $pesan = 'Waktu pendaftaran belum dibuka.';
            }

            return back()->with('error', $pesan);
        }

        DB::beginTransaction();
        try {
            // Generate username based on nama_lengkap
            $baseUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->nama_lengkap));
            // Default to 'user' if empty after regex
            if (empty($baseUsername)) $baseUsername = 'user';

            $username = $baseUsername;
            $counter = 1;
            while (Pengguna::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            // Create Pengguna
            $pengguna = Pengguna::create([
                'nama' => $request->nama_lengkap,
                'email' => $request->email,
                'username' => $username,
                'kata_sandi' => Hash::make($username), // default password is username
                'role' => 'peserta',
                'aktif' => 'aktif',
            ]);

            // Create Peserta
            $peserta = Peserta::create([
                'id_pengguna' => $pengguna->id,
            ]);

            // Create Pendaftaran
            Pendaftaran::create([
                'id_peserta' => $peserta->id,
                'id_program_microcredential' => $program->id,
                'status' => 'menunggu',
                'tanggal_daftar' => now(),
            ]);

            DB::commit();

            return redirect()->route('index')->with('success', 'Pendaftaran berhasil dikirim. Silakan cek status secara berkala di halaman Cek Akun.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Registration Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            return back()->with('error', 'Terjadi kesalahan saat pendaftaran: ' . $e->getMessage())->withInput();
        }
    }
}

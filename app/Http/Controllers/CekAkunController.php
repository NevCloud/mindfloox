<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Peserta;
use App\Models\Pendaftaran;

class CekAkunController extends Controller
{
    public function index()
    {
        return view('cek-akun');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $pengguna = Pengguna::where('email', $request->email)->where('role', 'peserta')->first();

        if (!$pengguna) {
            return back()->with('error', 'Data peserta tidak ditemukan dengan email tersebut.');
        }

        $peserta = Peserta::where('id_pengguna', $pengguna->id)->first();
        
        if (!$peserta) {
            return back()->with('error', 'Data detail peserta tidak ditemukan.');
        }

        // Ambil pendaftaran terbaru
        $pendaftaran = Pendaftaran::where('id_peserta', $peserta->id)->orderBy('dibuat_pada', 'desc')->first();

        if (!$pendaftaran) {
            return back()->with('error', 'Tidak ada riwayat pendaftaran untuk email ini.');
        }

        $status = $pendaftaran->status;

        if ($status === 'menunggu') {
            return back()->with('info', 'Pendaftaran Anda sedang dalam tahap verifikasi oleh Admin. Silakan cek kembali nanti.');
        }

        if ($status === 'ditolak') {
            return back()->with('error', 'Maaf, Anda gagal/ditolak. Catatan Admin: ' . ($pendaftaran->catatan_admin ?? 'Tidak ada catatan'));
        }

        if ($status === 'diterima') {
            return back()->with('success', [
                'message' => 'Selamat! Pendaftaran Anda diterima.',
                'username' => $pengguna->username,
                // Default password saat daftar adalah username-nya
                'password' => $pengguna->username 
            ]);
        }

        return back()->with('error', 'Status pendaftaran tidak diketahui.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\RateLimiter;

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

        $throttleKey = 'cekakun|' . $request->ip();

        $now = \Carbon\Carbon::now();
        $next6AM = \Carbon\Carbon::today()->addHours(6);
        if ($now->greaterThanOrEqualTo($next6AM)) {
            $next6AM->addDay();
        }
        $decaySeconds = $now->diffInSeconds($next6AM);

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $request->session()->put('cekakun_locked_until', $next6AM->timestamp);
            return back()->with('error', 'Batas percobaan cek akun Anda telah habis (3/3). Silakan coba lagi besok jam 06:00.');
        }

        $pengguna = Pengguna::where('email', $request->email)->where('role', 'peserta')->first();

        if (!$pengguna) {
            RateLimiter::hit($throttleKey, $decaySeconds);
            $attempts = RateLimiter::attempts($throttleKey);
            if ($attempts >= 3) {
                $request->session()->put('cekakun_locked_until', $next6AM->timestamp);
                return back()->with('error', 'Batas percobaan cek akun Anda telah habis (3/3). Silakan coba lagi besok jam 06:00.');
            }
            return back()->with('error', "Data peserta tidak ditemukan dengan email tersebut. (Percobaan $attempts/3)");
        }

        $peserta = Peserta::where('id_pengguna', $pengguna->id)->first();
        
        if (!$peserta) {
            RateLimiter::hit($throttleKey, $decaySeconds);
            $attempts = RateLimiter::attempts($throttleKey);
            if ($attempts >= 3) {
                $request->session()->put('cekakun_locked_until', $next6AM->timestamp);
                return back()->with('error', 'Batas percobaan cek akun Anda telah habis (3/3). Silakan coba lagi besok jam 06:00.');
            }
            return back()->with('error', "Data detail peserta tidak ditemukan. (Percobaan $attempts/3)");
        }

        // Ambil pendaftaran terbaru
        $pendaftaran = Pendaftaran::where('id_peserta', $peserta->id)->orderBy('dibuat_pada', 'desc')->first();

        if (!$pendaftaran) {
            RateLimiter::hit($throttleKey, $decaySeconds);
            $attempts = RateLimiter::attempts($throttleKey);
            if ($attempts >= 3) {
                $request->session()->put('cekakun_locked_until', $next6AM->timestamp);
                return back()->with('error', 'Batas percobaan cek akun Anda telah habis (3/3). Silakan coba lagi besok jam 06:00.');
            }
            return back()->with('error', "Tidak ada riwayat pendaftaran untuk email ini. (Percobaan $attempts/3)");
        }
        
        RateLimiter::clear($throttleKey);

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

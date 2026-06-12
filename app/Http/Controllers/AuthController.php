<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. VALIDASI INPUT DARI BACKEND
        // Memastikan bahwa user benar-benar mengirimkan teks (string) yang tidak kosong.
        // Jika ada yang kosong, Laravel akan otomatis menolak dan mengembalikan pesan error.
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. MENYIAPKAN SYARAT LOGIN (KREDENSIAL)
        // Kita menyuruh Laravel untuk mencari data berdasarkan 3 syarat:
        $credentials = [
            'username' => $request->input('username'), // Username harus cocok
            'password' => $request->input('password'), // Password (kata_sandi) harus cocok
            'aktif'    => 'aktif'                      // Status akun di database harus "aktif" (dibanned = tidak bisa login)
        ];

        // 3. PROSES PENGECEKAN KE DATABASE (Auth::attempt)
        // Auth::attempt secara otomatis mengenkripsi password inputan dan mencocokkannya dengan hash di database.
        if (Auth::attempt($credentials)) {
            
            // Jika login sukses, kita perbarui ID Session untuk mencegah peretasan "Session Fixation"
            $request->session()->regenerate();
            
            // Ambil seluruh data user yang berhasil login tersebut
            $user = Auth::user();

            // 4. PENGALIHAN HALAMAN (REDIRECT) BERDASARKAN ROLE
            // Arahkan user ke dasbor masing-masing sesuai hak aksesnya (kolom 'role')
            switch ($user->role) {
                case 'peserta':
                    return redirect('/peserta/dasbor');
                case 'instruktur':
                    return redirect('/instruktur/dasbor');
                case 'admin_microcredential':
                    return redirect('/admin/dasbor');
                case 'super_admin':
                    return redirect('/super-admin/dasbor');
                default:
                    // Jika rolenya aneh/tidak terdaftar, paksa logout demi keamanan
                    Auth::logout(); 
                    return redirect('/login')->with('error', 'Role Anda tidak valid.');
            }
        }

        // 5. JIKA LOGIN GAGAL
        // Kembalikan ke halaman sebelumnya (form login) dengan membawa pesan error
        return back()->with('error', 'Login gagal! Username atau password salah.');
    }

    public function logout(Request $request)
    {
        // Hapus data login dari sistem Auth Laravel
        Auth::logout();
        
        // Hancurkan semua data sesi (session) yang tersisa milik user tersebut
        $request->session()->invalidate();
        
        // Buat token keamanan baru untuk perlindungan serangan CSRF
        $request->session()->regenerateToken();
        
        // Arahkan kembali ke halaman form login
        return redirect('/login');
    }
}

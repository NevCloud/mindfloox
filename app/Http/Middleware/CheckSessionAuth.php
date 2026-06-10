<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSessionAuth
{
    /**
     * Handle an incoming request.
     * checking status login & role sebelum user masuk ke halaman.
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. CEK STATUS LOGIN:
        // Apakah user ini BUKAN orang yang sudah login?
        if (!Auth::check()) {
            // Jika belum login, tendang balik ke halaman login
            return redirect('/login');
        }

        // 2. CEK HAK AKSES (ROLE):
        // Apakah role dari user yang sedang login saat ini TIDAK SAMA dengan role yang diminta di routes/web.php?
        if (Auth::user()->role !== $role) {
            // Jika rolenya berbeda, tolak aksesnya dan munculkan pesan error 403 (Forbidden)
            return abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        // 3. IZINKAN MASUK:
        // Jika lolos dari dua pengecekan di atas, izinkan user melanjutkan perjalanannya ke Controller/View
        return $next($request);
    }
}

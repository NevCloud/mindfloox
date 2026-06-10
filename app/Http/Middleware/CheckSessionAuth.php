<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckSessionAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah ada user session (artinya sudah login)
        if (!Session::has('user')) {
            // Jika tidak ada session, kembalikan ke halaman login
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.');
        }

        // Opsional: Cek spesifik Role berdasarkan prefix URL
        // Misalnya: Hanya super-admin yang bisa akses /super-admin/*
        $user = Session::get('user');
        
        if ($request->is('super-admin/*') && $user['role'] !== 'Super Admin') {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        if ($request->is('admin/*') && !in_array($user['role'], ['Admin', 'Super Admin'])) {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($request->is('instruktur/*') && $user['role'] !== 'Instruktur') {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($request->is('peserta/*') && $user['role'] !== 'Peserta') {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}

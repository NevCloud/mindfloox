<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Ambil input
        $username = $request->input('username');
        $password = $request->input('password');
        $role     = $request->input('role');

        $users = [
            [
                'username' => 'peserta',
                'password' => '123456',
                'role' => 'Peserta'
            ],
            [
                'username' => 'instruktur',
                'password' => '123456',
                'role' => 'Instruktur'
            ],
            [
                'username' => 'admin',
                'password' => '123456',
                'role' => 'Admin'
            ],
            [
                'username' => 'superadmin',
                'password' => '123456',
                'role' => 'Super Admin'
            ],
        ];

        // 🔍 Cek user
        foreach ($users as $user) {
            if (
                $username === $user['username'] &&
                $password === $user['password'] 
            ) {
                // Simpan session
                Session::put('user', $user);

                // 🔁 Redirect berdasarkan role
                switch ($user['role']) {
                    case 'Peserta':
                        return redirect('/peserta/dashboard');
                    case 'Instruktur':
                        return redirect('/instructor/dashboard');
                    case 'Admin':
                        return redirect('/admin/dashboard');
                    case 'Super Admin':
                        return redirect('/super-admin/dashboard');
                }
            }
        }

        return back()->with('error', 'Login gagal! Data tidak cocok.');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }
}

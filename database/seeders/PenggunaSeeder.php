<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Budi Peserta',
                'username' => 'peserta',
                'email' => 'peserta@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'peserta',
                'aktif' => 'aktif'
            ],
            [
                'nama' => 'Andi Instruktur',
                'username' => 'instruktur',
                'email' => 'instruktur@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'instruktur',
                'aktif' => 'aktif'
            ],
            [
                'nama' => 'Siti Admin',
                'username' => 'admin',
                'email' => 'admin@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'admin_microcredential',
                'aktif' => 'aktif'
            ],
            [
                'nama' => 'Sutejo Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'super_admin',
                'aktif' => 'aktif'
            ],
        ];

        foreach ($users as $user) {
            Pengguna::updateOrCreate(['username' => $user['username']], $user);
        }
    }
}

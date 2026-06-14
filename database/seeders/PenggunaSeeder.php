<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Instruktur;
use App\Models\Pengguna;
use App\Models\SuperAdmin;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'peserta',
                'username' => 'peserta',
                'email' => 'peserta@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'peserta',
                'aktif' => 'aktif'
            ],
            [
                'nama' => 'instruktur',
                'username' => 'instruktur',
                'email' => 'instruktur@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'instruktur',
                'aktif' => 'aktif'
            ],
            [
                'nama' => 'admin',
                'username' => 'admin',
                'email' => 'admin@mindfloox.com',
                'kata_sandi' => Hash::make('123456'),
                'role' => 'admin_microcredential',
                'aktif' => 'aktif'
            ],
            [
                'nama' => 'superadmin',
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

        $superAdminPengguna = Pengguna::where('role', 'super_admin')->first();
        $superAdmin = SuperAdmin::firstOrCreate(['id_pengguna' => $superAdminPengguna->id]);

        $instrukturPengguna = Pengguna::where('role', 'instruktur')->get();
        foreach ($instrukturPengguna as $p) {
            Instruktur::firstOrCreate(
                ['id_pengguna' => $p->id],
                ['id_dibuat_oleh' => $superAdmin?->id ?? 1, 'keahlian' => 'Umum']
            );
        }
    }
}

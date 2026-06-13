<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk menambahkan UNIQUE constraint pada kolom username di tabel pengguna.
 * 
 * TUJUAN KEAMANAN:
 * - Mencegah duplikasi username di level DATABASE (lapisan pertahanan terakhir)
 * - Walaupun validasi Laravel gagal/bypass, database akan menolak data duplikat
 * - Penting untuk login: Auth::attempt() mengambil user PERTAMA yang match
 *   Jika ada 2 username sama, bisa login ke akun yang salah!
 * 
 * CARA KERJA:
 * - UNIQUE index memastikan tidak ada 2 baris dengan username yang sama
 * - Jika ada yang coba INSERT username duplikat, MySQL akan error
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan UNIQUE index pada kolom username.
     */
    public function up(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            // Tambahkan unique index bernama 'pengguna_username_unique'
            $table->unique('username', 'pengguna_username_unique');
        });
    }

    /**
     * Reverse the migrations.
     * Menghapus unique index jika rollback.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            // Hapus unique index
            $table->dropUnique('pengguna_username_unique');
        });
    }
};

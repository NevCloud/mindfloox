<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_peserta')->constrained('peserta');
            $table->foreignId('id_program_microcredential')->constrained('program_microcredential');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->nullable()->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->dateTime('tanggal_daftar');
            $table->dateTime('tanggal_verifikasi')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('admin_microcredential');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};

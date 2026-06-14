<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna')->constrained('pengguna');
            $table->boolean('akses_aktif')->default(false);
            $table->foreignId('diaktifkan_oleh')->nullable()->constrained('admin_microcredential');
            $table->timestamp('diaktifkan_pada')->nullable();
            $table->text('minat')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};

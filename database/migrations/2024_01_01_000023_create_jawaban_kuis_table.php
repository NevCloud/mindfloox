<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sesi_kuis')->constrained('sesi_kuis');
            $table->foreignId('id_pertanyaan')->constrained('pertanyaan_kuis');
            $table->unique(['id_sesi_kuis', 'id_pertanyaan'], 'uq_jawaban_per_pertanyaan');
            $table->foreignId('id_pilihan_jawaban')->nullable()->constrained('pilihan_jawaban');
            $table->text('teks_jawaban')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuis');
    }
};

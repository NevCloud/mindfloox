<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanyaan_kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kuis')->constrained('kuis');
            $table->text('teks_pertanyaan');
            $table->enum('tipe_pertanyaan', ['pilihan_ganda', 'esai'])->default('pilihan_ganda');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_kuis');
    }
};

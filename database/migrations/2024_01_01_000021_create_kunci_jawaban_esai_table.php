<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunci_jawaban_esai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pertanyaan')->constrained('pertanyaan_kuis');
            $table->text('teks_kunci');
            $table->boolean('case_sensitive')->default(false);
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunci_jawaban_esai');
    }
};

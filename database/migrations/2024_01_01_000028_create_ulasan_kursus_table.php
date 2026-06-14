<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasan_kursus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->constrained('pendaftaran');
            $table->foreignId('id_kursus')->constrained('kursus');
            $table->foreignId('id_kursus_instruktur')->constrained('kursus_instruktur');
            $table->unique(['id_pendaftaran', 'id_kursus', 'id_kursus_instruktur'], 'uq_ulasan_per_instruktur');
            $table->text('komentar_kursus')->nullable();
            $table->integer('rating_kursus')->nullable();
            $table->text('komentar_instruktur')->nullable();
            $table->integer('rating_instruktur')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_kursus');
    }
};

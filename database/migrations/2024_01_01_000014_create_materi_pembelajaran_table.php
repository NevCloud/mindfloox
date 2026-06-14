<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kursus')->constrained('kursus');
            $table->foreignId('id_kursus_instruktur')->constrained('kursus_instruktur');
            $table->foreignId('id_minggu')->constrained('minggu');
            $table->string('judul');
            $table->integer('nomor_urut');
            $table->enum('tipe', ['dokumen', 'video', 'tautan'])->nullable();
            $table->string('url_file')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_pembelajaran');
    }
};

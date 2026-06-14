<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_kursus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->constrained('pendaftaran');
            $table->foreignId('id_kursus')->constrained('kursus');
            $table->decimal('nilai_akhir', 5, 2);
            $table->boolean('status_lulus');
            $table->foreignId('ditentukan_oleh')->nullable()->constrained('instruktur');
            $table->text('catatan_instruktur')->nullable();
            $table->timestamp('dihitung_pada');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_kursus');
    }
};

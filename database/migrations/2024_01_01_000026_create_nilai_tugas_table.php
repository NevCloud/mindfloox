<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->constrained('pendaftaran');
            $table->foreignId('id_tugas')->constrained('tugas');
            $table->decimal('nilai_mentah', 5, 2);
            $table->foreignId('dinilai_oleh')->constrained('instruktur');
            $table->dateTime('dinilai_pada')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_tugas');
    }
};

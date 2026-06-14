<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kursus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_program_microcredential')->constrained('program_microcredential');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('foto_kursus');
            $table->decimal('nilai_kelulusan_kursus', 5, 2);
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kursus');
    }
};

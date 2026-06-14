<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_microcredential', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_microcredential')->constrained('jenis_microcredential');
            $table->foreignId('id_semester')->constrained('semester');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('foto_program');
            $table->enum('status_pendaftaran', ['tutup', 'buka'])->default('tutup');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_microcredential');
    }
};

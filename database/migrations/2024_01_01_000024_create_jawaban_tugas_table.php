<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->constrained('pendaftaran');
            $table->foreignId('id_tugas')->constrained('tugas');
            $table->unique(['id_pendaftaran', 'id_tugas'], 'uq_jawaban_tugas');
            $table->string('url_file');
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->dateTime('disubmit_pada')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_tugas');
    }
};

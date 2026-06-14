<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesi_kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->constrained('pendaftaran');
            $table->foreignId('id_kuis')->constrained('kuis');
            $table->unique(['id_pendaftaran', 'id_kuis'], 'uq_sesi_kuis');
            $table->enum('status', ['sedang', 'selesai', 'kedaluwarsa'])->default('sedang');
            $table->timestamp('dimulai_pada');
            $table->timestamp('diselesaikan_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesi_kuis');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kursus_instruktur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kursus')->constrained('kursus');
            $table->foreignId('id_instruktur')->constrained('instruktur');
            $table->unique(['id_kursus', 'id_instruktur'], 'uq_kursus_instruktur');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kursus_instruktur');
    }
};

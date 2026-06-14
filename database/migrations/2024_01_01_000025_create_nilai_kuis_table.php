<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sesi_kuis')->constrained('sesi_kuis');
            $table->decimal('nilai_mentah', 5, 2);
            $table->timestamp('dihitung_pada');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_kuis');
    }
};

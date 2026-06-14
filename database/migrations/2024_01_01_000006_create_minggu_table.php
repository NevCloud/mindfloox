<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('minggu', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_minggu');
            $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minggu');
    }
};

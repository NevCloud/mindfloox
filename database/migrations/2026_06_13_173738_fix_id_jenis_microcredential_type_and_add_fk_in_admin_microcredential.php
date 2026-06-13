<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Fix column type mismatch (bigint unsigned → int) and re-add FK.
     * admin_microcredential_ibfk_1 was dropped by a previous failed migration.
     * jenis_microcredential.id is INT, so id_jenis_microcredential must also be INT.
     */
    public function up(): void
    {
        // Fix type: bigint unsigned NOT NULL → int NOT NULL (match jenis_microcredential.id)
        DB::statement('ALTER TABLE `admin_microcredential` MODIFY `id_jenis_microcredential` INT NOT NULL');

        // Re-add FK
        Schema::table('admin_microcredential', function (Blueprint $table) {
            $table->foreign('id_jenis_microcredential', 'admin_microcredential_ibfk_1')
                ->references('id')
                ->on('jenis_microcredential')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('admin_microcredential', function (Blueprint $table) {
            $table->dropForeign('admin_microcredential_ibfk_1');
        });

        DB::statement('ALTER TABLE `admin_microcredential` MODIFY `id_jenis_microcredential` BIGINT UNSIGNED NOT NULL');
    }
};

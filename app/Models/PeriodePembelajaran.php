<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodePembelajaran extends Model
{
    protected $table = "periode_pembelajaran";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "tahun",
        "jenis",
        "tanggal_mulai",
        "tanggal_selesai"
    ];

    protected $casts = [
        "tanggal_mulai" => "date",
        "tanggal_selesai" => "date",
    ];

    public function programMicrocredential()
    {
        return $this->hasMany(ProgramMicrocredential::class, 'id_periode_pembelajaran');
    }
}

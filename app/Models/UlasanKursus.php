<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanKursus extends Model
{
    protected $table = "ulasan_kursus";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pendaftaran",
        "id_kursus",
        "rating_kursus",
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }
}

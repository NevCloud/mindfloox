<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusInstruktur extends Model
{
    protected $table = "kursus_instruktur";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kursus",
        "id_instruktur",
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'id_instruktur');
    }

    public function materiPembelajaran()
    {
        return $this->hasMany(MateriPembelajaran::class, 'id_kursus_instruktur');
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'id_kursus_instruktur');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_kursus_instruktur');
    }

    public function ulasanKursus()
    {
        return $this->hasMany(UlasanKursus::class, 'id_kursus_instruktur');
    }
}

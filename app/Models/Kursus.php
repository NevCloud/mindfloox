<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    protected $table = "kursus";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_program_microcredential",
        "nama",
        "deskripsi",
        "foto_kursus",
        "nilai_kelulusan_kursus",
    ];

    protected $casts = [
        "nilai_kelulusan_kursus" => "decimal:2",
    ];

    public function programMicrocredential()
    {
        return $this->belongsTo(ProgramMicrocredential::class, 'id_program_microcredential');
    }

    public function instruktur()
    {
        return $this->belongsToMany(Instruktur::class, 'kursus_instruktur', 'id_kursus', 'id_instruktur');
    }

    public function kursusInstruktur()
    {
        return $this->hasMany(KursusInstruktur::class, 'id_kursus');
    }

    public function materiPembelajaran()
    {
        return $this->hasMany(MateriPembelajaran::class, 'id_kursus');
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'id_kursus');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_kursus');
    }

    public function nilaiKursus()
    {
        return $this->hasMany(NilaiKursus::class, 'id_kursus');
    }

    public function ulasanKursus()
    {
        return $this->hasMany(UlasanKursus::class, 'id_kursus');
    }
}

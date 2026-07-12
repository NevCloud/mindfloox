<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = "tugas";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kursus",
        "id_kursus_instruktur",
        "id_minggu",
        "nomor_urut",
        "judul",
        "deskripsi",
        "tanggal_mulai",
        "batas_waktu",
    ];

    protected $casts = [
        "tanggal_mulai" => "datetime",
        "batas_waktu" => "datetime",
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }

    public function minggu()
    {
        return $this->belongsTo(Minggu::class, 'id_minggu');
    }

    public function kursusInstruktur()
    {
        return $this->belongsTo(KursusInstruktur::class, 'id_kursus_instruktur');
    }

    public function jawabanTugas()
    {
        return $this->hasMany(JawabanTugas::class, 'id_tugas');
    }

    public function nilaiTugas()
    {
        return $this->hasMany(NilaiTugas::class, 'id_tugas');
    }
}

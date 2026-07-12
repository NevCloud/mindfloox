<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_kursus',
        'id_kursus_instruktur',
        'judul',
        'deskripsi',
        'id_minggu',
        'nomor_urut',
        'batas_waktu_menit',
        'tanggal_mulai',
        'batas_waktu',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'batas_waktu' => 'datetime',
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

    public function pertanyaanKuis()
    {
        return $this->hasMany(PertanyaanKuis::class, 'id_kuis');
    }

    public function sesiKuis()
    {
        return $this->hasMany(SesiKuis::class, 'id_kuis');
    }
}

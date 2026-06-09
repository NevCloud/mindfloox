<?php

namespace App\Models;

use App\Enums\TipeMateri;
use Illuminate\Database\Eloquent\Model;

class MateriPembelajaran extends Model
{
    protected $table = 'materi_pembelajaran';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_kursus',
        'id_kursus_instruktur',
        'judul',
        'nomor_urut',
        'id_minggu',
        'tipe',
        'url_file',
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
}

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
        'nilai',
        'batas_waktu_menit',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];
}

<?php

namespace App\Models;

use App\Enums\StatusMinggu;
use Illuminate\Database\Eloquent\Model;

class Minggu extends Model
{
    protected $table = 'minggu';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_kursus',
        'nomor_minggu',
        'nama',
        'judul',
        'deskripsi',
        'status',
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }

    public function materiPembelajaran()
    {
        return $this->hasMany(MateriPembelajaran::class, 'id_minggu');
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'id_minggu');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_minggu');
    }
}

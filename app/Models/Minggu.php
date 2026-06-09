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
        'nomor_minggu',
        'status',
    ];

    public function materiPembelajaran()
    {
        return $this->hasMany(MateriPembelajaran::class, 'id_minggu');
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'id_minggu');
    }
}

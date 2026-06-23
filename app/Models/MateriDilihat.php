<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriDilihat extends Model
{
    protected $table = 'materi_dilihat';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pendaftaran',
        'id_materi_pembelajaran',
        'dilihat_pada',
    ];

    protected $casts = [
        'dilihat_pada' => 'datetime',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    public function materiPembelajaran()
    {
        return $this->belongsTo(MateriPembelajaran::class, 'id_materi_pembelajaran');
    }
}

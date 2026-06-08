<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = "pengguna";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        'nama',
        'username',
        'email',
        'kata_sandi',
        'role',
        'aktif',
        'foto_profil',
        'nomor_telepon',
        'alamat',
        'tanggal_lahir',
        'x',
        'facebook',
        'linkedin',
        'instagram',
    ];

    protected $casts = [
        "tanggal_lahir" => "date"
    ];
}

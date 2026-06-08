<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = "pendaftaran";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_peserta",
        "id_program_microcredential",
        "status",
        "catatan_admin",
        "tanggal_daftar",
        "tanggal_verifikasi",
        "diverifikasi_oleh",
    ];

    protected $casts = [
        "tanggal_daftar" => "datetime",
        "tanggal_verifikasi" => "datetime",
    ];

}

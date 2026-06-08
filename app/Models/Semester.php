<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = "semester";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "tahun",
        "jenis",
        "tanggal_mulai",
        "tanggal_selesai"
    ];

    protected $casts = [
        "tanggal_mulai" => "date",
        "tanggal_selesai" => "date",
    ];

}

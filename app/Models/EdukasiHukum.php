<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdukasiHukum extends Model
{
    protected $fillable = [
        'jenis_edukasi_id',
        'judul',
        'deskripsi',
        'file',
    ];

    public function jenis_edukasi()
    {
        return $this->belongsTo(JenisEdukasi::class);
    }
}

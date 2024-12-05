<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKejadianAnonim extends Model
{
    protected $fillable = [
        'tanggal',
        'jam',
        'lokasi_kejadian',
        'jenis_kejadian_id',
        'catatan_laporan',
        'longitude',
        'latitude',
    ];

    public function jenisKejadian()
    {
        return $this->belongsTo(JenisKejadian::class);
    }
}

<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class LaporanKejadianAnonim extends Model implements HasMedia
{
    use InteractsWithMedia;

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

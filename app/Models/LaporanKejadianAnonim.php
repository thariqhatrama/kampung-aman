<?php

namespace App\Models;

use App\Models\Kelurahan;
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
        'kelurahan_id',
        'catatan_laporan',
        'longitude',
        'latitude',
    ];

    public function jenisKejadian()
    {
        return $this->belongsTo(JenisKejadian::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
}

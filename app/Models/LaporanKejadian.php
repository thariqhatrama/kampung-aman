<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class LaporanKejadian extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam',
        // 'nama_pelapor',
        // 'no_tlp',
        'lokasi_kejadian',
        'jenis_kejadian_id',
        'catatan_laporan',
        'longitude',
        'latitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisKejadian()
    {
        return $this->belongsTo(JenisKejadian::class);
    }
}

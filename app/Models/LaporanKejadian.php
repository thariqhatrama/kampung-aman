<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKejadian extends Model
{
    protected $fillable = [
        'tanggal',
        'jam',
        'nama_pelapor',
        'no_tlp',
        'lokasi_kejadian',
        'lat',
        'long',
    ];
}

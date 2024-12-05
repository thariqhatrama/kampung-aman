<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KejadianStatusDaerah extends Model
{
    protected $fillable = ['status_daerah_id', 'jenis_kejadian_id', 'jumlah'];

    public function statusDaerah()
    {
        return $this->belongsTo(StatusDaerah::class);
    }

    public function jenisKejadian()
    {
        return $this->belongsTo(JenisKejadian::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusDaerah extends Model
{
    protected $fillable = ['kelurahan_id', 'jumlah_laporan'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kejadianStatusDaerah()
    {
        return $this->hasMany(KejadianStatusDaerah::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emergency extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam',
        // 'nama_pelapor',
        // 'no_tlp',
        'lokasi_kejadian',
        'longitude',
        'latitude',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

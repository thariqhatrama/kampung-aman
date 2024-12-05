<?php

namespace App\Models;

use Filament\Forms;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $fillable = ['nama', 'longitude', 'latitude'];

    public static function getForm()
    {
        return [
            Forms\Components\TextInput::make('nama')
                ->required(),
            Forms\Components\TextInput::make('longitude')
                ->required(),
            Forms\Components\TextInput::make('latitude')
                ->required(),
        ];
    }
}

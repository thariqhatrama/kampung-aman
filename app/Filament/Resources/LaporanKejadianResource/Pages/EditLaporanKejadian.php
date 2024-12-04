<?php

namespace App\Filament\Resources\LaporanKejadianResource\Pages;

use App\Filament\Resources\LaporanKejadianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKejadian extends EditRecord
{
    protected static string $resource = LaporanKejadianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

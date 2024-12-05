<?php

namespace App\Filament\Resources\LaporanKejadianAnonimResource\Pages;

use App\Filament\Resources\LaporanKejadianAnonimResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLaporanKejadianAnonims extends ManageRecords
{
    protected static string $resource = LaporanKejadianAnonimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LaporanKejadianResource\Pages;

use App\Filament\Resources\LaporanKejadianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanKejadians extends ListRecords
{
    protected static string $resource = LaporanKejadianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

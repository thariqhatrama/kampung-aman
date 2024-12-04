<?php

namespace App\Filament\Resources\JenisEdukasiResource\Pages;

use App\Filament\Resources\JenisEdukasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisEdukasis extends ManageRecords
{
    protected static string $resource = JenisEdukasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

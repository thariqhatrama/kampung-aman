<?php

namespace App\Filament\Resources\JenisKejadianResource\Pages;

use App\Filament\Resources\JenisKejadianResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisKejadians extends ManageRecords
{
    protected static string $resource = JenisKejadianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

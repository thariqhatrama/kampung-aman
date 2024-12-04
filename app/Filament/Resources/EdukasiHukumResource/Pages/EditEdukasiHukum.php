<?php

namespace App\Filament\Resources\EdukasiHukumResource\Pages;

use App\Filament\Resources\EdukasiHukumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEdukasiHukum extends EditRecord
{
    protected static string $resource = EdukasiHukumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

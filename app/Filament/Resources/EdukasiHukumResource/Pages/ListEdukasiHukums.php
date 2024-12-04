<?php

namespace App\Filament\Resources\EdukasiHukumResource\Pages;

use App\Filament\Resources\EdukasiHukumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEdukasiHukums extends ListRecords
{
    protected static string $resource = EdukasiHukumResource::class;
    protected static ?string $title = 'Edukasi Hukum & Kesadaran Sosial';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

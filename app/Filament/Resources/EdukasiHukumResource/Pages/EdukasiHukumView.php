<?php

namespace App\Filament\Resources\EdukasiHukumResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\EdukasiHukumResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class EdukasiHukumView extends Page
{
    use InteractsWithRecord;
    
    protected ?string $heading;
    protected static string $resource = EdukasiHukumResource::class;

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->heading = $this->record->judul;
    }

    protected static string $view = 'filament.resources.edukasi-hukum-resource.pages.edukasi-hukum-view';
}

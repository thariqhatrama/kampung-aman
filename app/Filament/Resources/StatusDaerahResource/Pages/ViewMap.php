<?php

namespace App\Filament\Resources\StatusDaerahResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\StatusDaerahResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ViewMap extends Page
{
    use InteractsWithRecord;

    public $tipe = 'status-daerah';
    public $longitude;
    public $latitude;
    
    protected static string $resource = StatusDaerahResource::class;

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->longitude = $this->record->kelurahan->longitude;
        $this->latitude = $this->record->kelurahan->latitude;
    }
    protected static string $view = 'filament.resources.view-map';
}

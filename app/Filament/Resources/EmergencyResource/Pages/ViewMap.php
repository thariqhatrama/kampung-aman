<?php

namespace App\Filament\Resources\EmergencyResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\EmergencyResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ViewMap extends Page
{
    use InteractsWithRecord;

    public $tipe = 'emergency';
    public $longitude;
    public $latitude;
    public $data;
    
    protected static string $resource = EmergencyResource::class;

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->data = $this->record;
        $this->longitude = $this->record->longitude;
        $this->latitude = $this->record->latitude;
    }
    protected static string $view = 'filament.resources.view-map';
}

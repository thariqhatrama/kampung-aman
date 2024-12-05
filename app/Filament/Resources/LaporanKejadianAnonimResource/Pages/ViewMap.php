<?php

namespace App\Filament\Resources\LaporanKejadianAnonimResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\LaporanKejadianAnonimResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ViewMap extends Page
{
    use InteractsWithRecord;

    public $tipe = 'laporan-kejadian-anonim';
    public $longitude;
    public $latitude;
    
    protected static string $resource = LaporanKejadianAnonimResource::class;

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        // $this->data = $this->record;
        $this->longitude = $this->record->longitude;
        $this->latitude = $this->record->latitude;
    }

    protected static string $view = 'filament.resources.view-map';
}

<?php

namespace App\Filament\Resources\StatusDaerahResource\Pages;

use App\Filament\Resources\StatusDaerahResource;
use App\Models\StatusDaerah;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStatusDaerahs extends ManageRecords
{
    protected static string $resource = StatusDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function ($data) {
                    $data['jumlah_laporan'] = 0;
                    return $data;
                })
                ->after(function ($record) {
                    $jumlahLaporan = $record->kejadianStatusDaerah->sum('jumlah');
                    $record->update([
                        'jumlah_laporan' => $jumlahLaporan,
                    ]);
                }),
        ];
    }
}

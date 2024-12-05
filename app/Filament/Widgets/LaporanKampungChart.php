<?php

namespace App\Filament\Widgets;

use App\Models\Kelurahan;
use App\Models\StatusDaerah;
use Filament\Widgets\ChartWidget;

class LaporanKampungChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Laporan berdasarkan Kampung';
    public ?string $filter = 'month';

    protected function getFilters(): ?array
    {
        return [
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $kelurahan = Kelurahan::all();
        if ($this->filter == 'month') {
            $statusDaerah = StatusDaerah::whereMonth('created_at', now()->month)->get();
        } elseif($this->filter == 'year') {
            $statusDaerah = StatusDaerah::whereYear('created_at', now()->year)->get();
        }else {
            $statusDaerah = StatusDaerah::all();
        }

        $data = $kelurahan->map(function ($kelurahan) use ($statusDaerah) {
            return $statusDaerah->where('kelurahan_id', $kelurahan->id)->sum('jumlah_laporan');
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Kejadian',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $kelurahan->pluck('nama')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

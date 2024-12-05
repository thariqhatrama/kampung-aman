<?php

namespace App\Filament\Widgets;

use App\Models\JenisKejadian;
use App\Models\LaporanKejadian;
use Filament\Widgets\ChartWidget;
use App\Models\LaporanKejadianAnonim;

class LaporanKejadianChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Laporan berdasarkan Jenis Kejadian';
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
        $kejadian = JenisKejadian::all();
        if ($this->filter == 'month') {
            $laporanKejadian = LaporanKejadian::whereMonth('created_at', now()->month)->get();
            $laporanKejadianAnonim = LaporanKejadianAnonim::whereMonth('created_at', now()->month)->get();
        } elseif($this->filter == 'year') {
            $laporanKejadian = LaporanKejadian::whereYear('created_at', now()->year)->get();
            $laporanKejadianAnonim = LaporanKejadianAnonim::whereYear('created_at', now()->year)->get();
        }else {
            $laporanKejadian = LaporanKejadian::all();
            $laporanKejadianAnonim = LaporanKejadianAnonim::all();
        }

        $data = $kejadian->map(function ($jenis) use ($laporanKejadian, $laporanKejadianAnonim) {
            $countLaporanKejadian = $laporanKejadian->where('jenis_kejadian_id', $jenis->id)->count();
            $countLaporanKejadianAnonim = $laporanKejadianAnonim->where('jenis_kejadian_id', $jenis->id)->count();
            return $countLaporanKejadian + $countLaporanKejadianAnonim;
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
            'labels' => $kejadian->pluck('nama')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

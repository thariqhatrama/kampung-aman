<?php

namespace App\Filament\Widgets;

use App\Models\Emergency;
use App\Models\LaporanKejadian;
use App\Models\LaporanKejadianAnonim;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $laporanKejadian = LaporanKejadian::count();
        $emergency = Emergency::count();
        $laporanAnonim = LaporanKejadianAnonim::count();

        return [
            Stat::make('Laporan Kejadian', $laporanKejadian)
                // ->description('32k increase')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Laporan Panic Button', $emergency)
                // ->description('7% decrease')
                // ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Laporan Kejadian Anonim',   $laporanAnonim)
                // ->description('3% increase')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}

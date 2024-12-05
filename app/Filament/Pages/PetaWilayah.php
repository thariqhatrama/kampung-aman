<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Emergency;
use App\Models\StatusDaerah;
use App\Models\LaporanKejadian;
use App\Models\LaporanKejadianAnonim;

class PetaWilayah extends Page
{
    public $geoJson;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public function mount(){
        $statusDaerah = StatusDaerah::all() ?? collect();
        $emergency = Emergency::all();
        $laporanKejadian = LaporanKejadian::all();
        $laporanKejadianAnonim = LaporanKejadianAnonim::all();

        // dd($statusDaerah, $emergency, $laporanKejadian, $laporanKejadianAnonim);
        $statusDaerah = $statusDaerah->map(function($item){
            $kejadian = $item->kejadianStatusDaerah->map(function($item){
                return $item->jenisKejadian?->nama ?? '';
            });
            return [
                'type' => 'Feature',
                'properties'=> [
                    'id' => $item->id,
                    'tipe' => 'status-daerah',
                    'total' => $item->jumlah_laporan.'x',
                    'kejadian' => implode(', ', $kejadian->toArray()),
                    'waktu' => '',
                    'pelapor' => '',
                    'lokasi' => $item->kelurahan->nama,
                    'iconSize' => [40, 40]
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $item->kelurahan->longitude,
                        $item->kelurahan->latitude
                    ]
                ]
            ];
        });

        $emergency = $emergency->map(function($item){
            return [
                'type' => 'Feature',
                'properties'=> [
                    'id' => $item->id,
                    'tipe' => 'emergency',
                    'total' => '1x',
                    'kejadian' => '',
                    'waktu' => $item->tanggal.' '.$item->jam,
                    'pelapor' => $item->user->name,
                    'lokasi' => $item->lokasi_kejadian,
                    'iconSize' => [40, 40]
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $item->longitude,
                        $item->latitude
                    ]
                ]
            ];
        });

        $laporanKejadian = $laporanKejadian->map(function($item){
            return [
                'type' => 'Feature',
                'properties'=> [
                    'id' => $item->id,
                    'tipe' => 'laporan-kejadian',
                    'total' => '1x',
                    'kejadian' => $item->jenisKejadian->nama,
                    'waktu' => $item->tanggal.' '.$item->jam,
                    'pelapor' => $item->user->name,
                    'lokasi' => $item->lokasi_kejadian,
                    'iconSize' => [20, 20]
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $item->longitude,
                        $item->latitude
                    ]
                ]
            ];
        });

        $laporanKejadianAnonim = $laporanKejadianAnonim->map(function($item){
            return [
                'type' => 'Feature',
                'properties'=> [
                    'id' => $item->id,
                    'tipe' => 'laporan-kejadian-anonim',
                    'total' => '1x',
                    'kejadian' => $item->jenisKejadian->nama,
                    'waktu' => $item->tanggal.' '.$item->jam,
                    'pelapor' => 'anonim',
                    'lokasi' => $item->lokasi_kejadian,
                    'iconSize' => [20, 20]
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $item->longitude,
                        $item->latitude
                    ]
                ]
            ];
        });
        $data = $statusDaerah
            ->merge($emergency)
            ->merge($laporanKejadian)
            ->merge($laporanKejadianAnonim);
        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => $data
        ];

        $this->geoJson = json_encode($geoJson);
    }

    protected static string $view = 'filament.pages.peta-wilayah';
}

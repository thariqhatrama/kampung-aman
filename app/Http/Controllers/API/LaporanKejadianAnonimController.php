<?php

namespace App\Http\Controllers\Api;

use App\Models\StatusDaerah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KejadianStatusDaerah;
use App\Models\LaporanKejadianAnonim;
use Illuminate\Support\Facades\Validator;

class LaporanKejadianAnonimController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi_kejadian' => 'required',
            'jenis_kejadian_id' => 'required',
            'kelurahan_id' => 'required',
            'catatan_laporan' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validate->errors(),
                'data' => null,
            ], 400);
        }

        $laporanKejadianAnonim = LaporanKejadianAnonim::create([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'jenis_kejadian_id' => $request->jenis_kejadian_id,
            'kelurahan_id' => $request->kelurahan_id,
            'catatan_laporan' => $request->catatan_laporan,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        if ($request->hasFile('foto')) {
            $pathToImage = $request->file('foto')->store('images', 'public');
            $laporanKejadianAnonim->addMedia(storage_path('app/public/' . $pathToImage))->toMediaCollection();
        }

        $statusDaerah = StatusDaerah::where('kelurahan_id', $request->kelurahan_id)->first();
        if(!$statusDaerah) {
            $statusDaerah = StatusDaerah::create([
                'kelurahan_id' => $request->kelurahan_id
            ]);
        }

        $kejadian = KejadianStatusDaerah::where('status_daerah_id', $statusDaerah->id)
            ->where('jenis_kejadian_id', $request->jenis_kejadian_id)->first();
        if(!$kejadian) {
            $kejadian = KejadianStatusDaerah::create([
                'status_daerah_id' => $statusDaerah->id,
                'jenis_kejadian_id' => $request->jenis_kejadian_id,
                'jumlah' => 0
            ]);
        }

        $kejadian = $kejadian->update([
                'jumlah' => $kejadian->jumlah + 1
            ]);
        $jumlahLaporan = $statusDaerah->update([
            'jumlah_laporan' => $statusDaerah->kejadianStatusDaerah->sum('jumlah')
        ]);
        
        return response()->json([
            'error' => false,
            'message' => 'Laporan kejadian anonim berhasil disimpan',
            'data' => $laporanKejadianAnonim,
        ]);
    }
}

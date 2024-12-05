<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Emergency;
use Illuminate\Support\Facades\Validator;

class EmergencyController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi_kejadian' => 'required',
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

        $laporanKejadianAnonim = Emergency::create([
            'user_id' => $request->user()->id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Laporan emergency berhasil disimpan',
            'data' => $laporanKejadianAnonim,
        ]);
    }
}

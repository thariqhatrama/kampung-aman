<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisKejadian;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function jenisKejadian()
    {
        $jenisKejadian = JenisKejadian::all();

        return response()->json([
            'error' => false,
            'message' => 'Data jenis kejadian berhasil diambil',
            'data' => $jenisKejadian,
        ]);
    }

    public function kelurahan()
    {
        $kelurahan = Kelurahan::all();

        return response()->json([
            'error' => false,
            'message' => 'Data kelurahan berhasil diambil',
            'data' => $kelurahan,
        ]);
    }
}

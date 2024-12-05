<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\EmergencyController;
use App\Http\Controllers\Api\LaporanKejadianAnonimController;
use App\Http\Controllers\Api\LaporanKejadianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/laporan-kejadian-anonim', [LaporanKejadianAnonimController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/jenis-kejadian', [DataController::class, 'jenisKejadian']);
    Route::get('/kelurahan', [DataController::class, 'kelurahan']);
    Route::post('/laporan-kejadian', [LaporanKejadianController::class, 'store']);
    Route::post('/emergency', [EmergencyController::class, 'store']);

    Route::get('/user', function (Request $request) {
        return response()->json([
            'error' => false,
            'data' => $request->user(),
        ]);
    });
});

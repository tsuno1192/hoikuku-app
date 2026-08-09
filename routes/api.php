<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftOptimizationController;
use App\Http\Controllers\Api\ConsultationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// 例: /api/v1/shifts/optimize などのエンドポイントにする場合
Route::middleware('auth:sanctum')->post('/shifts/optimize', [ShiftOptimizationController::class, 'generate']);

// 認証が必要なルート（API的な処理をweb.phpに書いている場合）
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::post('/consultations', [ConsultationController::class, 'store']);
    Route::post('/consultations/{id}/messages', [ConsultationController::class, 'sendMessage']);
    Route::patch('/consultations/{id}/status', [ConsultationController::class, 'updateStatus']);
});
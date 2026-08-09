<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShiftMatrixController;
use App\Http\Controllers\Admin\ShiftOptimizationController as AdminShiftOptimizationController; // 管理者用

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 管理者向けルートまとめ
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // 管理者向けマトリクスデータ取得API
    Route::get('/shifts/matrix', [ShiftMatrixController::class, 'index']);

    // 管理者向けシフト管理マトリクス画面
    Route::get('/shifts/matrix-view', function () {
        return view('admin.shifts.index');
    })->name('shifts.matrix');

    // シフト自動割り当て実行画面の表示
    Route::get('/shifts/optimize', [AdminShiftOptimizationController::class, 'create'])->name('shifts.optimize');
    
    // シフト自動割り当て処理の実行
    Route::post('/shifts/optimize', [AdminShiftOptimizationController::class, 'store'])->name('shifts.optimize.store');
});

require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\StockItemController;
use App\Http\Controllers\StockReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/health', fn () => response()->json([
    'status' => 'OK',
    'timestamp' => now(),
]));

Route::prefix('warehouse')->name('warehouse.')->group(function () {
    Route::get('/', [StockItemController::class, 'index'])->name('index');
    Route::post('/', [StockItemController::class, 'store'])
        ->middleware('scanner.token')
        ->name('store');
    Route::get('/report', [StockReportController::class, 'summary'])->name('report');
    Route::get('/{id}', [StockItemController::class, 'show'])
        ->whereNumber('id')
        ->name('show');
});

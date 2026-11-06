<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockItemController;
use App\Http\Middleware\CheckScannerToken;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('stock-items')->group(function () {
    Route::get('/', [StockItemController::class, 'index']);
    Route::get('/{id}', [StockItemController::class, 'show']);
    Route::post('/', [StockItemController::class, 'store'])->middleware(CheckScannerToken::class);
});
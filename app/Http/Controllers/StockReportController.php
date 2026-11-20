<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\StockItem;
use Illuminate\Http\JsonResponse;

class StockReportController extends Controller
{
    public function summary(): JsonResponse
    {
        $totalPositions = StockItem::count();
        $totalUnits = (int) StockItem::sum('quantity');
        $zonesCovered = StockItem::query()
            ->distinct()
            ->pluck('location_zone')
            ->values();

        return response()->json([
            'status' => 'success',
            'report' => [
                'total_positions' => $totalPositions,
                'total_units' => $totalUnits,
                'zones_covered' => $zonesCovered,
                'generated_at' => now()->toDateTimeString(),
            ],
        ], 200);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class StockReportController extends Controller
{
    public function summary(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'report' => [
                'total_positions' => 2,
                'total_units' => 23,
                'active_zones' => ['A-01', 'B-04'],
            ],
        ], 200);
    }
}

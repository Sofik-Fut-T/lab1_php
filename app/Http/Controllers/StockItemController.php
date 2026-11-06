<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    private array $items = [
        [
            'id' => 1,
            'title' => 'Штрихкод Сканер Datalogic',
            'sku' => 'SKU-1001',
            'quantity' => 15,
            'location_zone' => 'Zone-A1',
        ],
        [
            'id' => 2,
            'title' => 'Термінал збору даних Zebra',
            'sku' => 'SKU-1002',
            'quantity' => 8,
            'location_zone' => 'Zone-B2',
        ],
        [
            'id' => 3,
            'title' => 'Принтер етикеток Xprinter',
            'sku' => 'SKU-1003',
            'quantity' => 3,
            'location_zone' => 'Zone-C3',
        ],
    ];

    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->items,
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'sku' => ['required', 'string', 'min:3', 'max:50'],
            'quantity' => ['required', 'integer', 'min:0'],
            'location_zone' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        $newItem = [
            'id' => count($this->items) + 1,
            'title' => $validated['title'],
            'sku' => $validated['sku'],
            'quantity' => (int) $validated['quantity'],
            'location_zone' => $validated['location_zone'],
        ];

        $this->items[] = $newItem;

        return response()->json([
            'status' => 'created',
            'data' => $newItem,
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $itemId = (int) $id;

        foreach ($this->items as $item) {
            if ($item['id'] === $itemId) {
                return response()->json([
                    'status' => 'success',
                    'data' => $item,
                ], 200);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Товар на складі з таким ID не знайдено.',
        ], 404);
    }
}
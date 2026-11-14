<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\StockItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    /**
     * Повертає список складських позицій із підвантаженими категорією та постачальниками (Eager Loading).
     */
    public function index(Request $request): JsonResponse
    {
        $items = StockItem::query()
            ->with(['category:id,name', 'suppliers:id,name,code'])
            ->where('is_active', true)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $items,
        ], 200);
    }

    /**
     * Створення нової позиції на складі з прив'язкою категорії (1:M) та постачальників (M:M).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'sku' => ['required', 'string', 'min:3', 'max:50', 'unique:stock_items,sku'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'location_zone' => ['required', 'string', 'min:2', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'suppliers' => ['nullable', 'array'],
            'suppliers.*' => ['integer', 'exists:suppliers,id'],
        ]);

        $item = StockItem::create([
            'category_id' => (int) $validated['category_id'],
            'sku' => $validated['sku'],
            'title' => $validated['title'],
            'quantity' => (int) $validated['quantity'],
            'location_zone' => $validated['location_zone'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        if (! empty($validated['suppliers'])) {
            $item->suppliers()->sync($validated['suppliers']);
        }

        $item->load(['category:id,name', 'suppliers:id,name,code']);

        return response()->json([
            'status' => 'created',
            'data' => $item,
        ], 201);
    }

    /**
     * Отримання конкретної товарної позиції за ID разом зі зв'язками.
     */
    public function show(string $id): JsonResponse
    {
        $item = StockItem::with(['category', 'suppliers'])->find((int) $id);

        if (! $item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Товар на складі з таким ID не знайдено.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $item,
        ], 200);
    }
}

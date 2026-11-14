<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Category;
use App\Models\StockItem;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WarehouseDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_fetch_stock_items_with_relations(): void
    {
        $category = Category::factory()->create(['name' => 'Термінали обліку']);
        $supplier = Supplier::factory()->create(['name' => 'ТехноСклад']);
        $item = StockItem::factory()->create([
            'category_id' => $category->id,
            'title' => 'Сканер Honeywell',
            'is_active' => true,
        ]);
        $item->suppliers()->attach($supplier->id);

        $response = $this->getJson('/warehouse');

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Сканер Honeywell'])
            ->assertJsonFragment(['name' => 'Термінали обліку'])
            ->assertJsonFragment(['name' => 'ТехноСклад']);
    }

    public function test_can_create_stock_item_with_category_and_suppliers_in_database(): void
    {
        $category = Category::factory()->create();
        $suppliers = Supplier::factory()->count(2)->create();

        $payload = [
            'category_id' => $category->id,
            'sku' => 'SKU-8899',
            'title' => 'Мобільний принтер чеків',
            'quantity' => 14,
            'location_zone' => 'Zone-A2',
            'is_active' => true,
            'suppliers' => $suppliers->pluck('id')->toArray(),
        ];

        $response = $this->withHeaders(['X-Scanner-Token' => 'valid-scanner-token'])
            ->postJson('/warehouse', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('stock_items', [
            'sku' => 'SKU-8899',
            'title' => 'Мобільний принтер чеків',
            'category_id' => $category->id,
        ]);

        $itemId = $response->json('data.id');
        foreach ($suppliers as $supplier) {
            $this->assertDatabaseHas('stock_item_supplier', [
                'stock_item_id' => $itemId,
                'supplier_id' => $supplier->id,
            ]);
        }
    }
}

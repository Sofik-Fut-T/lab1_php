<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WarehouseAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_without_scanner_token_is_blocked_by_middleware(): void
    {
        $response = $this->postJson('/warehouse', [
            'sku' => 'SKU-9999',
            'title' => 'Тестовий сканер',
            'quantity' => 5,
            'location_zone' => 'Zone-A1',
        ]);

        $response->assertStatus(403);
    }

    public function test_request_with_valid_scanner_token_passes_middleware(): void
    {
        $category = Category::factory()->create();

        $response = $this->withHeaders([
            'X-Scanner-Token' => 'valid-scanner-token',
        ])->postJson('/warehouse', [
            'category_id' => $category->id,
            'sku' => 'SKU-9999',
            'title' => 'Тестовий сканер',
            'quantity' => 5,
            'location_zone' => 'Zone-A1',
        ]);

        $response->assertStatus(201);
    }
}

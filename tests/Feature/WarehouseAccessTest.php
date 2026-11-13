<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class WarehouseAccessTest extends TestCase
{
    public function test_request_without_scanner_token_is_blocked_by_middleware(): void
    {
        $response = $this->postJson('/warehouse', [
            'sku' => 'WH-2001',
            'title' => 'Термінал збору даних',
            'quantity' => 5,
            'location_zone' => 'C-02',
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'status' => 'access_denied',
            ]);
    }

    public function test_request_with_valid_scanner_token_passes_middleware(): void
    {
        $response = $this->withHeaders([
            'X-Scanner-Token' => 'SCANNER-SECRET-01',
        ])->postJson('/warehouse', [
            'sku' => 'WH-2001',
            'title' => 'Термінал збору даних',
            'quantity' => 5,
            'location_zone' => 'C-02',
        ]);

        $response->assertStatus(201);
        $response->assertHeader('X-Security-Policy', 'Enforced');
    }
}

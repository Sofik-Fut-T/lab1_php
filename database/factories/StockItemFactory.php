<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'sku' => fake()->unique()->regexify('SKU-[0-9]{4}'),
            'title' => ucfirst(fake()->words(3, true)),
            'quantity' => fake()->numberBetween(1, 100),
            'location_zone' => fake()->randomElement(['Zone-A1', 'Zone-A2', 'Zone-B1', 'Zone-B2', 'Zone-C3']),
            'is_active' => fake()->boolean(90),
        ];
    }
}

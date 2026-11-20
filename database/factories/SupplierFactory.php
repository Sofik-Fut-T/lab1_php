<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'code' => fake()->unique()->regexify('SUP-[0-9]{4}'),
            'contact_email' => fake()->unique()->companyEmail(),
        ];
    }
}

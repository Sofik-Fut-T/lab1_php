<?php

declare(strict_types=1);

namespace App\Models;

class Product extends AbstractEntity
{
    public function __construct(
        string $id,
        string $createdAt,
        private string $name,
        private float $price
    ) {
        parent::__construct($id, $createdAt);
    }

    public function getDetails(): string
    {
        return "Product: {$this->name}, Price: {$this->price} UAH (ID: {$this->id})";
    }
}

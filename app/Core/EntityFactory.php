<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\AbstractEntity;
use App\Models\Product;
use App\Models\User;
use InvalidArgumentException;

class EntityFactory
{
    public static function createEntity(string $type, array $data): AbstractEntity
    {
        return match ($type) {
            'product' => new Product(
                $data['id'] ?? uniqid(),
                $data['createdAt'] ?? date('Y-m-d H:i:s'),
                $data['name'],
                (float) $data['price']
            ),
            'user' => new User(
                $data['id'] ?? uniqid(),
                $data['createdAt'] ?? date('Y-m-d H:i:s'),
                $data['name'],
                $data['email']
            ),
            default => throw new InvalidArgumentException("Unknown entity type: {$type}"),
        };
    }
}

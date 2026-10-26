<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\ExportableInterface;
use App\Traits\JsonExportTrait;

class User extends AbstractEntity implements ExportableInterface
{
    use JsonExportTrait;

    public function __construct(
        string $id,
        string $createdAt,
        private string $name,
        private string $email
    ) {
        parent::__construct($id, $createdAt);
    }

    public function getDetails(): string
    {
        return "User: {$this->name}, Email: {$this->email} (ID: {$this->id})";
    }
}

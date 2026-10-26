<?php

declare(strict_types=1);

namespace App\Tasks;

class Student
{
    public function __construct(
        public int $id,
        public string $name,
        public string $surname,
        public string $birthday
    ) {}
}

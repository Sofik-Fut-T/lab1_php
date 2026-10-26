<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\LoggerInterface;
use App\Models\AbstractEntity;

class EntityService
{
    public function __construct(
        private LoggerInterface $logger
    ) {}

    public function processEntity(AbstractEntity $entity): void
    {
        $this->logger->log('Processing entity: '.$entity->getDetails());
    }
}

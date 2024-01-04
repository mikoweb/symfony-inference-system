<?php

namespace App\Module\Core\Domain\Dataset;

interface DatasetCacheInterface
{
    public function get(string $datasetPath, callable $dataFactory, ?int $expiresAfter = null): mixed;
    public function delete(string $datasetPath): bool;
    public function clearExpired(): bool;
    public function clearAll(): bool;
}

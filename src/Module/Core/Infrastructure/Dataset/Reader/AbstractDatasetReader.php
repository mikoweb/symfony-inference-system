<?php

namespace App\Module\Core\Infrastructure\Dataset\Reader;

use App\Module\Core\Application\Path\AppPathResolver;
use App\Module\Core\Infrastructure\Dataset\DatasetCache;

abstract class AbstractDatasetReader
{
    public function __construct(
        private readonly AppPathResolver $pathResolver,
        protected readonly DatasetCache $datasetCache
    ) {}

    protected abstract function getDatasetFolderName(): string;
    protected abstract function getDatasetFileName(): string;

    protected function createDatasetPath(): string
    {
        $datasetFolderName = $this->getDatasetFolderName();
        $datasetFileName = $this->getDatasetFileName();

        return $this->pathResolver->getDatasetPath("$datasetFolderName/$datasetFileName");
    }
}

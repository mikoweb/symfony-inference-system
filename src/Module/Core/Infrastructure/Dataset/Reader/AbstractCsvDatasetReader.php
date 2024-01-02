<?php

namespace App\Module\Core\Infrastructure\Dataset\Reader;

use League\Csv\Reader;
use League\Csv\Exception;
use League\Csv\UnavailableStream;

abstract class AbstractCsvDatasetReader extends AbstractDatasetReader
{
    /**
     * @throws Exception
     * @throws UnavailableStream
     */
    protected function createReader(?int $headerOffset = 0): Reader
    {
        $reader = Reader::createFromPath($this->createDatasetPath());
        $reader->setHeaderOffset($headerOffset);

        return $reader;
    }
}

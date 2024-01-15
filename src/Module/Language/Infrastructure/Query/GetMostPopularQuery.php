<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\Query\GetMostPopularQueryInterface;
use App\Module\Language\Infrastructure\Reader\MostPopularDatasetReader;

final class GetMostPopularQuery implements GetMostPopularQueryInterface
{
    private static ?MostPopularHashMap $mostPopular = null;

    public function __construct(
        private readonly MostPopularDatasetReader $mostPopularDatasetReader
    ) {}

    public function getMostPopular(): MostPopularHashMap
    {
        if (is_null(self::$mostPopular)) {
            self::$mostPopular = $this->mostPopularDatasetReader->loadDataset();
        }

        return self::$mostPopular;
    }
}

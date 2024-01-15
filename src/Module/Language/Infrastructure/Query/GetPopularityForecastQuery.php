<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\Query\GetPopularityForecastQueryInterface;
use App\Module\Language\Infrastructure\Reader\PopularityForecastDatasetReader;

final class GetPopularityForecastQuery implements GetPopularityForecastQueryInterface
{
    private static ?MostPopularHashMap $forecast = null;

    public function __construct(
        private readonly PopularityForecastDatasetReader $popularityForecastDatasetReader
    ) {}

    public function getForecast(): MostPopularHashMap
    {
        if (is_null(self::$forecast)) {
            self::$forecast = $this->popularityForecastDatasetReader->loadDataset();
        }

        return self::$forecast;
    }
}

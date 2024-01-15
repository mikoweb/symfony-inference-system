<?php

namespace App\Module\Language\Domain\Query;

use App\Module\Language\Domain\MostPopular\MostPopularHashMap;

interface GetPopularityForecastQueryInterface
{
    public function getForecast(): MostPopularHashMap;
}

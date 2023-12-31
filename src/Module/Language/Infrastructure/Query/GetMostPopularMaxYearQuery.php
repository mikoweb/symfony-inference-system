<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\MostPopular\MostPopularList;
use App\Module\Language\Domain\MostPopular\MostPopularValue;
use App\Module\Language\Domain\Query\GetMostPopularMaxYearQueryInterface;
use Psr\Cache\InvalidArgumentException;

final class GetMostPopularMaxYearQuery implements GetMostPopularMaxYearQueryInterface
{
    private static ?int $maxYear = null;

    public function __construct(
        private readonly GetMostPopularQuery $getMostPopularQuery,
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function getMaxYear(): int
    {
        if (is_null(self::$maxYear)) {
            $mostPopular = $this->getMostPopularQuery->getMostPopular();

            if ($mostPopular->isEmpty()) {
                self::$maxYear = 0;
            } else {
                /** @var MostPopularList $list */
                $list = array_values($mostPopular->toArray())[0];
                self::$maxYear = $list->reduce(fn(int $max, MostPopularValue $value) => max($value->year, $max), 0);
            }
        }

        return self::$maxYear;
    }
}

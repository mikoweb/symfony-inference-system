<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\Query\GetMostPopularMaxYearQueryInterface;
use App\Module\Language\Domain\Query\GetMostPopularQueryInterface;

final class GetMostPopularMaxYearQuery implements GetMostPopularMaxYearQueryInterface
{
    private static ?int $maxYear = null;

    public function __construct(
        private readonly GetMostPopularQueryInterface $getMostPopularQuery,
    ) {}

    public function getMaxYear(): int
    {
        if (is_null(self::$maxYear)) {
            $mostPopular = $this->getMostPopularQuery->getMostPopular();
            self::$maxYear = $mostPopular->getMaxYear();
        }

        return self::$maxYear;
    }
}

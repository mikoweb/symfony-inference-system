<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\MostPopular\MostPopularList;
use App\Module\Language\Domain\Query\GetMostPopularYearRankingQueryInterface;
use Psr\Cache\InvalidArgumentException;
use Ramsey\Collection\Sort;

final class GetMostPopularYearRankingQuery implements GetMostPopularYearRankingQueryInterface
{
    private static ?MostPopularList $list = null;

    public function __construct(
        private readonly GetMostPopularQuery $getMostPopularQuery,
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function getRanking(int $year): MostPopularList
    {
        if (is_null(self::$list)) {
            $mostPopular = $this->getMostPopularQuery->getMostPopular();
            $list = new MostPopularList();

            foreach ($mostPopular as $years) {
                /** @var MostPopularList $years */
                $yearItem = $years->where('year', $year)->first();
                $list->add($yearItem);
            }

            /** @var MostPopularList $sorted */
            $sorted = $list->sort('percentageValue', Sort::Descending);

            self::$list = $sorted;
        }

        return self::$list;
    }
}

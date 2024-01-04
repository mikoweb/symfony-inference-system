<?php

namespace App\Module\Language\Domain\Query;

use App\Module\Language\Domain\MostPopular\MostPopularList;

interface GetMostPopularYearRankingQueryInterface
{
    public function getRanking(int $year): MostPopularList;
}

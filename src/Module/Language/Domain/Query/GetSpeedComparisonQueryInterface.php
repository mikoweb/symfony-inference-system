<?php

namespace App\Module\Language\Domain\Query;

use App\Module\Language\Domain\SpeedComparison\SpeedComparisonHashMap;

interface GetSpeedComparisonQueryInterface
{
    public function getSpeedComparison(): SpeedComparisonHashMap;
}

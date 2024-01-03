<?php

namespace App\Module\Language\Domain\SpeedComparison;

use Ramsey\Collection\Map\AbstractTypedMap;

final class SpeedComparisonHashMap extends AbstractTypedMap
{
    public function getKeyType(): string
    {
        return 'string';
    }

    public function getValueType(): string
    {
        return SpeedComparisonData::class;
    }
}

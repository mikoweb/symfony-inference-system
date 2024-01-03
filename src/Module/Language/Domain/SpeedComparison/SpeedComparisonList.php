<?php

namespace App\Module\Language\Domain\SpeedComparison;

use Ramsey\Collection\AbstractCollection;

final class SpeedComparisonList extends AbstractCollection
{
    public function getType(): string
    {
        return SpeedComparisonData::class;
    }
}

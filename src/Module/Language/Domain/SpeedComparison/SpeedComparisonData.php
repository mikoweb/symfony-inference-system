<?php

namespace App\Module\Language\Domain\SpeedComparison;

final readonly class SpeedComparisonData
{
    public function __construct(
        public string $langName,
        public float $median,
    ) {}
}

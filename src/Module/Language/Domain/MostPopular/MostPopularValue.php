<?php

namespace App\Module\Language\Domain\MostPopular;

final readonly class MostPopularValue
{
    public function __construct(
        public string $langKey,
        public int $year,
        public float $percentageValue
    ) {}
}

<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

use Closure;

final readonly class FuzzyRule
{
    public function __construct(
        public FuzzyTypeEnum $type,
        public FuzzyPointList $points,
        public ?Closure $customFunction = null
    ) {}
}

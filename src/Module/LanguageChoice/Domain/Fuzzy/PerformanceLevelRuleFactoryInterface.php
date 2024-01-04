<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

interface PerformanceLevelRuleFactoryInterface
{
    public function create(PerformanceLevelEnum $minimumPerformanceLevel): FuzzyRule;
}

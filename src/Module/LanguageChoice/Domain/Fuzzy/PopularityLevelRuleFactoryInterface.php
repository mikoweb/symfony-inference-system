<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

interface PopularityLevelRuleFactoryInterface
{
    public function create(PopularityLevelEnum $minimumPopularityLevel): FuzzyRule;
}

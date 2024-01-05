<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategy;

use App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategyInterface;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyFeatureFactory;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule\PerformanceLevelRuleFactory;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;

final class PerformanceLevelFeatureStrategy implements FeatureStrategyInterface
{
    public function isSupports(LanguageFilter $filter): bool
    {
        return !is_null($filter->minimumPerformanceLevel);
    }

    public function createFeature(LanguageFilter $filter): Feature
    {
        $rule = (new PerformanceLevelRuleFactory())->create($filter->minimumPerformanceLevel);

        return (new FuzzyFeatureFactory())->create('performance', $rule);
    }
}

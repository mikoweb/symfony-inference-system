<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategy;

use App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategyInterface;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyFeatureFactory;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule\PopularityLevelRuleFactory;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;

final class PopularityLevelFeatureStrategy implements FeatureStrategyInterface
{
    public function isSupports(LanguageFilter $filter): bool
    {
        return !is_null($filter->minimumPopularityLevel);
    }

    public function createFeature(LanguageFilter $filter): Feature
    {
        $rule = (new PopularityLevelRuleFactory())->create($filter->minimumPopularityLevel);

        return (new FuzzyFeatureFactory())->create('popularity', $rule);
    }
}

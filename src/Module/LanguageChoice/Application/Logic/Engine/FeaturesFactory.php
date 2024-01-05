<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine;

use App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategy\PerformanceLevelFeatureStrategy;
use App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategy\PopularityLevelFeatureStrategy;
use App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategy\UserExperienceFeatureStrategy;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;

final class FeaturesFactory
{
    /**
     * @var FeatureStrategyInterface[]
     */
    private array $strategies;

    public function __construct(
        PerformanceLevelFeatureStrategy $performanceLevelFeatureStrategy,
        PopularityLevelFeatureStrategy $popularityLevelFeatureStrategy,
        UserExperienceFeatureStrategy $userExperienceFeatureStrategy
    ) {
        $this->strategies = [
            $performanceLevelFeatureStrategy,
            $popularityLevelFeatureStrategy,
            $userExperienceFeatureStrategy
        ];
    }

    /**
     * @param LanguageFilter $filter
     * @return Feature[]
     */
    function createFeatures(LanguageFilter $filter): array
    {
        $features = [];

        foreach ($this->strategies as $strategy) {
            if ($strategy->isSupports($filter)) {
                $features[] = $strategy->createFeature($filter);
            }
        }

        return $features;
    }
}

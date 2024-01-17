<?php

namespace App\Module\LanguageChoice\Domain;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItemList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;

final readonly class LanguageFilter
{
    public function __construct(
        public ?LanguageUsageList $usage = null,
        public LanguageFilterModeEnum $usageMode = LanguageFilterModeEnum::AND,
        public ?LanguageFeatureList $features = null,
        public LanguageFilterModeEnum $featuresMode = LanguageFilterModeEnum::AND,
        public ?PerformanceLevelEnum $minimumPerformanceLevel = null,
        public ?PopularityLevelEnum $minimumPopularityLevel = null,
        public ?UserExperienceFilterItemList $userExperienceFilterItemList = null
    ) {}

    public function isSubmitted(bool $applyUsage = true, bool $applyFeatures = true): bool
    {
        return !empty($this->getNonNullValues($applyUsage, $applyFeatures));
    }

    private function getNonNullValues(bool $applyUsage = true, bool $applyFeatures = true): array
    {
        $values = [
            $this->minimumPerformanceLevel,
            $this->minimumPopularityLevel,
            $this->userExperienceFilterItemList,
        ];

        if ($applyUsage) {
            $values[] = $this->usage;
        }

        if ($applyFeatures) {
            $values[] = $this->features;
        }

        return array_values(array_filter($values, fn ($value) => !is_null($value)));
    }
}

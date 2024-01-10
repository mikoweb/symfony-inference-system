<?php

namespace App\Module\LanguageChoice\Domain;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItemList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;

final readonly class LanguageFilter
{
    public function __construct(
        public ?LanguageUsageList $usage = null,
        public ?PerformanceLevelEnum $minimumPerformanceLevel = null,
        public ?PopularityLevelEnum $minimumPopularityLevel = null,
        public ?UserExperienceFilterItemList $userExperienceFilterItemList = null
    ) {}

    public function isSubmitted(bool $applyUsage = true): bool
    {
        return !empty($this->getNonNullValues($applyUsage));
    }

    private function getNonNullValues(bool $applyUsage = true): array
    {
        $values = [
            $this->minimumPerformanceLevel,
            $this->minimumPopularityLevel,
            $this->userExperienceFilterItemList
        ];

        if ($applyUsage) {
            $values[] = $this->usage;
        }

        return array_values(array_filter($values, fn ($value) => !is_null($value)));
    }
}

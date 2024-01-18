<?php

namespace App\Module\LanguageChoice\Domain;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Dto\LanguageFilterDto;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItemList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use UnitEnum;

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

    public function toDto(): LanguageFilterDto
    {
        return new LanguageFilterDto(
            usage: !is_null($this->usage)
                ? array_map(fn (UnitEnum $enum) => $enum->value, $this->usage->toArray())
                : null,
            usageMode: $this->usageMode?->value,
            features: !is_null($this->features)
                ? array_map(fn (UnitEnum $enum) => $enum->value, $this->features->toArray())
                : null,
            featuresMode: $this->featuresMode?->value,
            minimumPerformanceLevel: $this->minimumPerformanceLevel?->value,
            minimumPopularityLevel: $this->minimumPopularityLevel?->value,
            userExperienceFilterItemList: $this->userExperienceFilterItemList?->toArray(),
        );
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

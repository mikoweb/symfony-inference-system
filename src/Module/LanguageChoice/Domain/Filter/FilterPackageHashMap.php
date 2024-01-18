<?php

namespace App\Module\LanguageChoice\Domain\Filter;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageFilterModeEnum;
use Ramsey\Collection\Map\AbstractTypedMap;

final class FilterPackageHashMap extends AbstractTypedMap
{
    private static ?self $commonMap = null;

    public function getKeyType(): string
    {
        return 'string';
    }

    public function getValueType(): string
    {
        return LanguageFilter::class;
    }

    public static function getCommonMap(): self
    {
        if (is_null(self::$commonMap)) {
            self::$commonMap = new self([
                FilterPackageKeyEnum::DATA_SCIENCE->value => new LanguageFilter(
                    usage: new LanguageUsageList([
                        LanguageUsageEnum::SCIENTIFIC,
                        LanguageUsageEnum::STATISTICS,
                        LanguageUsageEnum::AI,
                    ]),
                    usageMode: LanguageFilterModeEnum::OR,
                    minimumPerformanceLevel: PerformanceLevelEnum::MEDIUM,
                    minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
                ),
                FilterPackageKeyEnum::DESKTOP->value => new LanguageFilter(
                    usage: new LanguageUsageList([LanguageUsageEnum::DESKTOP]),
                    minimumPerformanceLevel: PerformanceLevelEnum::MEDIUM,
                    minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
                ),
                FilterPackageKeyEnum::EMBEDDED->value => new LanguageFilter(
                    usage: new LanguageUsageList([LanguageUsageEnum::EMBEDDED]),
                    minimumPerformanceLevel: PerformanceLevelEnum::VERY_HIGH,
                ),
                FilterPackageKeyEnum::MOBILE->value => new LanguageFilter(
                    usage: new LanguageUsageList([LanguageUsageEnum::MOBILE]),
                    minimumPerformanceLevel: PerformanceLevelEnum::MEDIUM,
                    minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
                ),
                FilterPackageKeyEnum::WEB->value => new LanguageFilter(
                    usage: new LanguageUsageList([LanguageUsageEnum::WEB]),
                    usageMode: LanguageFilterModeEnum::AND,
                    features: new LanguageFeatureList([LanguageFeatureEnum::OBJECT_ORIENTED]),
                    featuresMode: LanguageFilterModeEnum::AND,
                    minimumPerformanceLevel: PerformanceLevelEnum::LOW,
                    minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
                ),
            ]);
        }

        return self::$commonMap;
    }
}

<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItem;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItemList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\UserExperienceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageFilterModeEnum;

final class InferenceEngineWebResultsTest extends AbstractInferenceEngineTest
{
    public function testWebResults(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::WEB]),
            usageMode: LanguageFilterModeEnum::AND,
            features: new LanguageFeatureList([LanguageFeatureEnum::OBJECT_ORIENTED]),
            featuresMode: LanguageFilterModeEnum::AND,
            minimumPerformanceLevel: PerformanceLevelEnum::LOW,
            minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
            userExperienceFilterItemList: new UserExperienceFilterItemList([
                new UserExperienceFilterItem('php', UserExperienceLevelEnum::VERY_HIGH->name),
                new UserExperienceFilterItem('javascript', UserExperienceLevelEnum::HIGH->name),
                new UserExperienceFilterItem('java', UserExperienceLevelEnum::MEDIUM->name),
                new UserExperienceFilterItem('python', UserExperienceLevelEnum::VERY_LOW->name),
                new UserExperienceFilterItem('ruby', UserExperienceLevelEnum::VERY_LOW->name),
            ]),
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(30, $results);
        $this->assertCountResultNonZero(16, $results);

        $this->assertResultsOrder([
            'javascript',
            'java',
            'php',
            'c_sharp',
            'c_plus_plus',
            'python',
            'rust',
            'go',
            'scala',
            'nim',
            'ruby',
            'kotlin',
            'dart',
            'groovy',
            'perl',
            'object_pascal',
        ], $results);
    }

    public function testWebResultsNoUserExperienceFilter(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::WEB]),
            usageMode: LanguageFilterModeEnum::AND,
            features: new LanguageFeatureList([LanguageFeatureEnum::OBJECT_ORIENTED]),
            featuresMode: LanguageFilterModeEnum::AND,
            minimumPerformanceLevel: PerformanceLevelEnum::LOW,
            minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(30, $results);
        $this->assertCountResultNonZero(16, $results);

        $this->assertResultsOrder([
            'java',
            'javascript',
            'c_sharp',
            'c_plus_plus',
            'python',
            'php',
            'rust',
            'go',
            'scala',
            'nim',
            'kotlin',
            'ruby',
            'dart',
            'groovy',
            'perl',
            'object_pascal',
        ], $results);
    }

    public function testWebResultsNoUserExperienceAndPopularityFilter(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::WEB]),
            usageMode: LanguageFilterModeEnum::AND,
            features: new LanguageFeatureList([LanguageFeatureEnum::OBJECT_ORIENTED]),
            featuresMode: LanguageFilterModeEnum::AND,
            minimumPerformanceLevel: PerformanceLevelEnum::LOW,
            minimumPopularityLevel: PopularityLevelEnum::VERY_LOW,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(30, $results);
        $this->assertCountResultNonZero(16, $results);

        $this->assertResultsOrder([
            'c_plus_plus',
            'c_sharp',
            'go',
            'java',
            'javascript',
            'rust',
            'php',
            'scala',
            'python',
            'kotlin',
            'nim',
            'ruby',
            'dart',
            'groovy',
            'perl',
            'object_pascal',
        ], $results);
    }

    public function testWebClientSideResults(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::WEB, LanguageUsageEnum::CLIENT_SIDE]),
            usageMode: LanguageFilterModeEnum::AND,
            features: new LanguageFeatureList([LanguageFeatureEnum::OBJECT_ORIENTED]),
            featuresMode: LanguageFilterModeEnum::AND,
            minimumPerformanceLevel: PerformanceLevelEnum::LOW,
            minimumPopularityLevel: PopularityLevelEnum::HIGH,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(6, $results);
        $this->assertCountResultNonZero(4, $results);

        $this->assertResultsOrder([
            'java',
            'javascript',
            'c_sharp',
            'kotlin',
            'actionscript30',
            'eiffel',
        ], $results);
    }
}

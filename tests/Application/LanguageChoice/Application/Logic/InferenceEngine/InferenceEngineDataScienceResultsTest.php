<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageFilterModeEnum;

final class InferenceEngineDataScienceResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([
                LanguageUsageEnum::SCIENTITIFIC,
                LanguageUsageEnum::STATISTICS,
                LanguageUsageEnum::AI,
            ]),
            usageMode: LanguageFilterModeEnum::OR,
            minimumPerformanceLevel: PerformanceLevelEnum::MEDIUM,
            minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(11, $results);
        $this->assertCountResultNonZero(3, $results);

        $this->assertResultsOrder(['python', 'r', 'matlab'], $results);
    }
}

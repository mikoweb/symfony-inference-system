<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;

final class InferenceEngineDesktopResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::DESKTOP]),
            minimumPerformanceLevel: PerformanceLevelEnum::MEDIUM,
            minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
        );

        $results = $this->getEngine()->createResults($filter);


        $this->assertCount(7, $results);
        $this->assertCountResultNonZero(6, $results);

        $this->assertResultsOrder([
            'java',
            'c_sharp',
            'c_plus_plus',
            'python',
            'visual_basic',
            'object_pascal',
        ], $results);
    }
}

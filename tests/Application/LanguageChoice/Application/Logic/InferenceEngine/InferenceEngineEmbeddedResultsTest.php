<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;

final class InferenceEngineEmbeddedResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::EMBEDDED]),
            minimumPerformanceLevel: PerformanceLevelEnum::VERY_HIGH,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(6, $results);
        $this->assertCountResultNonZero(4, $results);

        $this->assertResultsOrder([
            'assembly_language',
            'c',
            'c_plus_plus',
            'ada',
            'lua',
        ], $results);
    }
}

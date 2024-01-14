<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;

final class InferenceEnginePerformanceResultsTest extends AbstractInferenceEngineTest
{
    public function testVeryHighResults(): void
    {
        $filter = new LanguageFilter(
            minimumPerformanceLevel: PerformanceLevelEnum::VERY_HIGH,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(134, $results);
        $this->assertCountResultNonZero(16, $results);

        $this->assertResultsOrder([
            'assembly_language',
            'julia',
            'c',
            'c_plus_plus',
            'nim',
            'd',
            'rust',
            'go',
            'ada',
            'scala',
            'swift',
            'common_lisp',
            'java',
            'c_sharp',
            'crystal',
            'javascript',
        ], $results);
    }

    public function testHighResults(): void
    {
        $filter = new LanguageFilter(
            minimumPerformanceLevel: PerformanceLevelEnum::HIGH,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(134, $results);
        $this->assertCountResultNonZero(18, $results);

        $this->assertResultsOrder([
            'assembly_language',
            'c',
            'c_plus_plus',
            'd',
            'julia',
            'nim',
            'rust',
            'go',
            'ada',
            'scala',
            'swift',
            'common_lisp',
            'java',
            'c_sharp',
            'crystal',
            'javascript',
            'haskell',
            'r',
        ], $results);
    }

    public function testLowResults(): void
    {
        $filter = new LanguageFilter(
            minimumPerformanceLevel: PerformanceLevelEnum::LOW,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(134, $results);
        $this->assertCountResultNonZero(23, $results);

        $this->assertResultsOrder([
            'ada',
            'assembly_language',
            'c',
            'c_plus_plus',
            'c_sharp',
            'common_lisp',
            'crystal',
            'd',
            'go',
            'java',
            'javascript',
            'julia',
            'nim',
            'rust',
            'scala',
            'swift',
            'haskell',
            'r',
            'clojure',
            'lua',
            'php',
            'elixir',
            'python',
        ], $results);
    }
}

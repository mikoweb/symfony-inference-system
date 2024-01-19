<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;

final class InferenceEnginePopularityResultsTest extends AbstractInferenceEngineTest
{
    public function testVeryHighResults(): void
    {
        $filter = new LanguageFilter(
            minimumPopularityLevel: PopularityLevelEnum::VERY_HIGH,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(134, $results);
        $this->assertCountResultNonZero(28, $results);

        $this->assertResultsOrder([
            'python',
            'java',
            'javascript',
            'c_sharp',
            'c',
            'c_plus_plus',
            'php',
            'r',
            'swift',
            'objective_c',
            'rust',
            'go',
            'kotlin',
            'matlab',
            'ruby',
            'ada',
            'powershell',
            'dart',
            'scala',
            'visual_basic',
            'lua',
            'julia',
            'cobol',
            'groovy',
            'perl',
            'haskell',
            'object_pascal',
            'pascal',
        ], $results);
    }

    public function testVeryHighResults2028(): void
    {
        $filter = new LanguageFilter(
            minimumPopularityLevel: PopularityLevelEnum::VERY_HIGH,
            popularityForecastYear: 2028,
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(134, $results);
        $this->assertCountResultNonZero(22, $results);

        $this->assertResultsOrder([
            'python',
            'java',
            'javascript',
            'c',
            'c_plus_plus',
            'c_sharp',
            'r',
            'kotlin',
            'rust',
            'go',
            'php',
            'dart',
            'ada',
            'powershell',
            'matlab',
            'lua',
            'swift',
            'julia',
            'objective_c',
            'cobol',
            'haskell',
            'groovy',
        ], $results);
    }
}

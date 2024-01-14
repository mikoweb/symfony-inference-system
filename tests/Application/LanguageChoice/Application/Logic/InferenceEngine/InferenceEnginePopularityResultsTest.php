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
}

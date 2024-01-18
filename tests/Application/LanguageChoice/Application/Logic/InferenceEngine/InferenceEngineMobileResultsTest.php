<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\Filter\FilterPackageHashMap;
use App\Module\LanguageChoice\Domain\Filter\FilterPackageKeyEnum;

final class InferenceEngineMobileResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = FilterPackageHashMap::getCommonMap()->get(FilterPackageKeyEnum::MOBILE->value);
        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(9, $results);
        $this->assertCountResultNonZero(8, $results);

        $this->assertResultsOrder([
            'java',
            'c_sharp',
            'c_plus_plus',
            'swift',
            'objective_c',
            'kotlin',
            'dart',
            'object_pascal',
        ], $results);
    }
}

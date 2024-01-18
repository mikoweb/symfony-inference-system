<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\Filter\FilterPackageHashMap;
use App\Module\LanguageChoice\Domain\Filter\FilterPackageKeyEnum;

final class InferenceEngineDesktopResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = FilterPackageHashMap::getCommonMap()->get(FilterPackageKeyEnum::DESKTOP->value);
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

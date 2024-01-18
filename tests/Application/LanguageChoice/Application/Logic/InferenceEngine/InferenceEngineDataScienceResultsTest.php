<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\Filter\FilterPackageHashMap;
use App\Module\LanguageChoice\Domain\Filter\FilterPackageKeyEnum;

final class InferenceEngineDataScienceResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = FilterPackageHashMap::getCommonMap()->get(FilterPackageKeyEnum::DATA_SCIENCE->value);
        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(11, $results);
        $this->assertCountResultNonZero(3, $results);

        $this->assertResultsOrder(['python', 'r', 'matlab'], $results);
    }
}

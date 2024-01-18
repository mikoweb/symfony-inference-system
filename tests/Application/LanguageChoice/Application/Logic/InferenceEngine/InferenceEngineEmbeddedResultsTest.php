<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\Filter\FilterPackageHashMap;
use App\Module\LanguageChoice\Domain\Filter\FilterPackageKeyEnum;

final class InferenceEngineEmbeddedResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = FilterPackageHashMap::getCommonMap()->get(FilterPackageKeyEnum::EMBEDDED->value);
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

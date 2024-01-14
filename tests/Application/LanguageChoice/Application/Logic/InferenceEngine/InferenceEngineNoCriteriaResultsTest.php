<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\LanguageFilter;

final class InferenceEngineNoCriteriaResultsTest extends AbstractInferenceEngineTest
{
    public function testResults(): void
    {
        $filter = new LanguageFilter();
        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(0, $results);
        $this->assertCountResultNonZero(0, $results);
    }

    public function testOnlySimpleFilterResults(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::GENERAL])
        );

        $results = $this->getEngine()->createResults($filter);

        $this->assertCount(45, $results);
        $this->assertCountResultNonZero(0, $results);
    }
}

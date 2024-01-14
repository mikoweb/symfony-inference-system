<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\InferenceEngine;

use App\Module\LanguageChoice\Domain\LanguageInferenceEngineInterface;
use App\Module\LanguageChoice\Domain\LanguageInferenceResult;
use App\Module\LanguageChoice\Domain\LanguageInferenceResultList;
use App\Tests\AbstractApplicationTestCase;

abstract class AbstractInferenceEngineTest extends AbstractApplicationTestCase
{
    protected function assertResultsOrder(array $langsOrder, LanguageInferenceResultList $results): void
    {
        foreach ($langsOrder as $key => $langId) {
            $this->assertEquals($langId, $results[$key]->langId);
        }
    }

    protected function assertCountResultNonZero(int $expectedCount, LanguageInferenceResultList $results): void
    {
        $count = $results->filter(fn (LanguageInferenceResult $result) => $result->score > 0.0)->count();
        $this->assertEquals($expectedCount, $count);
    }

    protected function getEngine(): LanguageInferenceEngineInterface
    {
        return $this->getService(LanguageInferenceEngineInterface::class);
    }
}

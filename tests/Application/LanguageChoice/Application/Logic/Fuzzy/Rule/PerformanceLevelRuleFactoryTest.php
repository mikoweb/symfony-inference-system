<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\Fuzzy\Rule;

use App\Module\Language\Domain\SpeedComparison\SpeedComparisonHashMap;
use App\Module\Language\Infrastructure\Query\GetSpeedComparisonQuery;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyFeatureFactory;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyResultGenerator;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule\PerformanceLevelRuleFactory;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Tests\AbstractApplicationTestCase;
use ketili\Feature;
use ketili\Item;

final class PerformanceLevelRuleFactoryTest extends AbstractApplicationTestCase
{
    public function testVeryHigh(): void
    {
        $minLevel = PerformanceLevelEnum::VERY_HIGH;

        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('php')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('python')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('r')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('ruby')));

        $this->assertResultBetween(
            0.1,
            0.2,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('javascript'))
        );

        $this->assertResultBetween(
            0.35,
            0.5,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('java'))
        );

        $this->assertResultBetween(
            0.3,
            0.45,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('c_sharp'))
        );

        $this->assertResultBetween(
            0.5,
            0.7,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('swift'))
        );

        $this->assertResultBetween(
            0.6,
            0.8,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('go'))
        );

        $this->assertResultBetween(
            0.95,
            1.0,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('c'))
        );

        $this->assertResultBetween(
            0.95,
            1.0,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus'))
        );

        $this->assertResultBetween(
            0.95,
            1.0,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('rust'))
        );
    }

    public function testHigh(): void
    {
        $minLevel = PerformanceLevelEnum::HIGH;

        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('ruby')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('php')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('python')));

        $this->assertResultBetween(
            0.1,
            0.3,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('r'))
        );

        $this->assertResultBetween(
            0.7,
            0.9,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('javascript'))
        );

        $this->assertResultBetween(
            0.8,
            0.95,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('java'))
        );

        $this->assertResultBetween(
            0.8,
            0.9,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('c_sharp'))
        );

        $this->assertResultBetween(
            0.9,
            0.97,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('swift'))
        );

        $this->assertResultBetween(
            0.9,
            0.97,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('go'))
        );

        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
    }

    public function testMedium(): void
    {
        $minLevel = PerformanceLevelEnum::MEDIUM;

        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('ruby')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('php')));
        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('python')));

        $this->assertResultBetween(
            0.4,
            0.5,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('r'))
        );

        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('javascript')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('java')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_sharp')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('swift')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('go')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
    }

    public function testLow(): void
    {
        $minLevel = PerformanceLevelEnum::LOW;

        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('ruby')));

        $this->assertResultBetween(
            0.3,
            0.4,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('python'))
        );

        $this->assertResultBetween(
            0.6,
            0.8,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('php'))
        );

        $this->assertResultBetween(
            0.9,
            1,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('r'))
        );

        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('javascript')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('java')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_sharp')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('swift')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('go')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
    }

    public function testVeryLow(): void
    {
        $minLevel = PerformanceLevelEnum::VERY_LOW;

        $this->assertEquals(0, $this->getRuleResult($minLevel, -$this->getLanguageValue('ruby')));

        $this->assertResultBetween(
            0.4,
            0.6,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('python'))
        );

        $this->assertResultBetween(
            0.7,
            0.9,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('php'))
        );

        $this->assertResultBetween(
            0.9,
            1,
            $this->getRuleResult($minLevel, -$this->getLanguageValue('r'))
        );

        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('javascript')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('java')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_sharp')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('swift')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('go')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('c_plus_plus')));
        $this->assertEquals(1, $this->getRuleResult($minLevel, -$this->getLanguageValue('rust')));
    }

    private function assertResultBetween(float $from, float $to, float $result): void
    {
        $this->assertThat(
            $result,
            $this->logicalAnd(
                $this->greaterThanOrEqual($from),
                $this->lessThanOrEqual($to)
            )
        );
    }

    private function getRuleResult(PerformanceLevelEnum $minLevel, float $speed): float
    {
        $results = $this->createGenerator()->generate([
            $this->getFeature($minLevel)
        ], [
            new Item('test_lang', ['performance' => $speed])
        ]);

        return $results[0]->score;
    }

    private function createGenerator(): FuzzyResultGenerator
    {
        return new FuzzyResultGenerator();
    }

    private function getFeature(PerformanceLevelEnum $minLevel): Feature
    {
        $rule = (new PerformanceLevelRuleFactory())->create($minLevel);

        return (new FuzzyFeatureFactory())->create('performance', $rule);
    }

    private function getLanguageValue(string $langId): float
    {
        return $this->getSpeedComparison()->get($langId)->median;
    }

    private function getSpeedComparison(): SpeedComparisonHashMap
    {
        return $this->getService(GetSpeedComparisonQuery::class)->getSpeedComparison();
    }
}

<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\Fuzzy\Rule;

use App\Module\Language\Domain\Query\GetSpeedComparisonQueryInterface;
use App\Module\Language\Domain\SpeedComparison\SpeedComparisonHashMap;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Tests\AbstractApplicationTestCase;

final class PerformanceLevelValueTest extends AbstractApplicationTestCase
{
    public function testPhp(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::LOW,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('php'))
        );
    }

    public function testRuby(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::VERY_LOW,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('ruby'))
        );
    }

    public function testPython(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::VERY_LOW,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('python'))
        );
    }

    public function testJava(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('java'))
        );
    }

    public function testCSharp(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('c_sharp'))
        );
    }

    public function testJavaScript(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('javascript'))
        );
    }

    public function testR(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::MEDIUM,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('r'))
        );
    }

    public function testC(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::VERY_HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('c'))
        );
    }

    public function testCPlusPlus(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::VERY_HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('c_plus_plus'))
        );
    }

    public function testRust(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::VERY_HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('rust'))
        );
    }

    public function testGo(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('go'))
        );
    }

    public function testScala(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('scala'))
        );
    }

    public function testSwift(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::HIGH,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('swift'))
        );
    }

    public function testHaskell(): void
    {
        $this->assertEquals(
            PerformanceLevelEnum::MEDIUM,
            PerformanceLevelEnum::fromSpeedComparisonValue($this->getLanguageValue('haskell'))
        );
    }

    private function getLanguageValue(string $langId): float
    {
        return $this->getSpeedComparison()->get($langId)->median;
    }

    private function getSpeedComparison(): SpeedComparisonHashMap
    {
        return $this->getService(GetSpeedComparisonQueryInterface::class)->getSpeedComparison();
    }
}

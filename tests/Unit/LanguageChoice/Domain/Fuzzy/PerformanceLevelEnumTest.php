<?php

namespace App\Tests\Unit\LanguageChoice\Domain\Fuzzy;

use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use PHPUnit\Framework\TestCase;

final class PerformanceLevelEnumTest extends TestCase
{
    public function testCases(): void
    {
        $cases = array_map(fn(PerformanceLevelEnum $enum) => $enum->name, PerformanceLevelEnum::cases());

        $this->assertEquals(['VERY_HIGH', 'HIGH', 'MEDIUM', 'LOW', 'VERY_LOW'], $cases);
    }

    public function testCompare(): void
    {
        $this->assertGreaterThan(PerformanceLevelEnum::VERY_LOW->value, PerformanceLevelEnum::LOW->value);
        $this->assertGreaterThan(PerformanceLevelEnum::LOW->value, PerformanceLevelEnum::MEDIUM->value);
        $this->assertGreaterThan(PerformanceLevelEnum::MEDIUM->value, PerformanceLevelEnum::HIGH->value);
        $this->assertGreaterThan(PerformanceLevelEnum::HIGH->value, PerformanceLevelEnum::VERY_HIGH->value);
    }

    public function testFrom()
    {
        $level = PerformanceLevelEnum::from(200);
        $this->assertEquals(PerformanceLevelEnum::MEDIUM, $level);
    }

    public function testFromString()
    {
        $level = PerformanceLevelEnum::fromString('MEDIUM');
        $this->assertEquals(PerformanceLevelEnum::MEDIUM, $level);
    }

    public function testFromSpeedComparisonValue()
    {
        $level = PerformanceLevelEnum::fromSpeedComparisonValue(200);
        $this->assertEquals(PerformanceLevelEnum::HIGH, $level);
    }
}

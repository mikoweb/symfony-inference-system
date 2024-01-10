<?php

namespace App\Tests\Unit\LanguageChoice\Domain\Fuzzy;

use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelPointEnum;
use PHPUnit\Framework\TestCase;

class PopularityLevelEnumTest extends TestCase
{
    public function testCases(): void
    {
        $cases = array_map(fn (PopularityLevelEnum $enum) => $enum->name, PopularityLevelEnum::cases());

        $this->assertEquals(['VERY_HIGH', 'HIGH', 'MEDIUM', 'LOW', 'VERY_LOW'], $cases);
    }

    public function testCompare(): void
    {
        $this->assertGreaterThan(PopularityLevelEnum::VERY_LOW->value, PopularityLevelEnum::LOW->value);
        $this->assertGreaterThan(PopularityLevelEnum::LOW->value, PopularityLevelEnum::MEDIUM->value);
        $this->assertGreaterThan(PopularityLevelEnum::MEDIUM->value, PopularityLevelEnum::HIGH->value);
        $this->assertGreaterThan(PopularityLevelEnum::HIGH->value, PopularityLevelEnum::VERY_HIGH->value);
    }

    public function testFrom(): void
    {
        $level = PopularityLevelEnum::from(200);
        $this->assertEquals(PopularityLevelEnum::MEDIUM, $level);
    }

    public function testFromString(): void
    {
        $level = PopularityLevelEnum::fromString('MEDIUM');
        $this->assertEquals(PopularityLevelEnum::MEDIUM, $level);
    }

    public function testFromPopularityValue(): void
    {
        $level = PopularityLevelEnum::fromPopularityValue(12);
        $this->assertEquals(PopularityLevelEnum::VERY_HIGH, $level);

        $level = PopularityLevelEnum::fromPopularityValue(11.99);
        $this->assertEquals(PopularityLevelEnum::HIGH, $level);

        $level = PopularityLevelEnum::fromPopularityValue(8);
        $this->assertEquals(PopularityLevelEnum::HIGH, $level);

        $level = PopularityLevelEnum::fromPopularityValue(7.99);
        $this->assertEquals(PopularityLevelEnum::MEDIUM, $level);

        $level = PopularityLevelEnum::fromPopularityValue(4);
        $this->assertEquals(PopularityLevelEnum::MEDIUM, $level);

        $level = PopularityLevelEnum::fromPopularityValue(3.99);
        $this->assertEquals(PopularityLevelEnum::LOW, $level);

        $level = PopularityLevelEnum::fromPopularityValue(1);
        $this->assertEquals(PopularityLevelEnum::LOW, $level);

        $level = PopularityLevelEnum::fromPopularityValue(0.99);
        $this->assertEquals(PopularityLevelEnum::VERY_LOW, $level);

        $level = PopularityLevelEnum::fromPopularityValue(0);
        $this->assertEquals(PopularityLevelEnum::VERY_LOW, $level);
    }

    public function testToPoint(): void
    {
        foreach (PopularityLevelEnum::cases() as $case) {
            $this->assertEquals(PopularityLevelPointEnum::fromString($case->name), $case->toPointEnum());
        }
    }

    public function testMediumPoint(): void
    {
        $this->assertEquals(8, PopularityLevelEnum::MEDIUM->toPointEnum()->value);
    }
}

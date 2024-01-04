<?php

namespace App\Tests\Unit\LanguageChoice\Application\Logic\Fuzzy;

use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyFeatureFactory;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyPointList;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyRule;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyTypeEnum;
use ketili\membership\polygon\Trapmf;
use ketili\membership\polygon\Trimf;
use PHPUnit\Framework\TestCase;

final class FuzzyFeatureFactoryTest extends TestCase
{
    public function testTrimf(): void
    {
        $pointList = new FuzzyPointList([100.0, 120.0, 150.0]);

        $feature = $this->createFactory()->create('test_feature', new FuzzyRule(
            type: FuzzyTypeEnum::TRIMF,
            points: $pointList,
        ));

        $this->assertEquals('test_feature', $feature->identifier);
        $this->assertEquals(1.0, $feature->weight);

        $function = $feature->mem_function;
        $this->assertInstanceOf(Trimf::class, $function);

        $this->assertEquals(100.0, $function->a);
        $this->assertEquals(120.0, $function->b);
        $this->assertEquals(150.0, $function->c);
    }

    public function testTrapmf(): void
    {
        $pointList = new FuzzyPointList([90.0, 115.0, 125.0, 170.0]);

        $feature = $this->createFactory()->create('test_feature', new FuzzyRule(
            type: FuzzyTypeEnum::TRAPMF,
            points: $pointList,
        ), 0.5);

        $this->assertEquals('test_feature', $feature->identifier);
        $this->assertEquals(0.5, $feature->weight);

        $function = $feature->mem_function;
        $this->assertInstanceOf(Trapmf::class, $function);

        $this->assertEquals(90.0, $function->a);
        $this->assertEquals(115.0, $function->b);
        $this->assertEquals(125.0, $function->c);
        $this->assertEquals(170.0, $function->d);
    }

    private function createFactory(): FuzzyFeatureFactory
    {
        return new FuzzyFeatureFactory();
    }
}

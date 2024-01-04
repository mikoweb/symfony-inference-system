<?php

namespace App\Tests\Application\LanguageChoice\Application\Logic\Fuzzy\Rule;

use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\MostPopular\MostPopularList;
use App\Module\Language\Infrastructure\Query\GetMostPopularQuery;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyFeatureFactory;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyResultGenerator;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule\PopularityLevelRuleFactory;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Tests\AbstractApplicationTestCase;
use ketili\Feature;
use ketili\Item;

final class PopularityLevelRuleFactoryTest extends AbstractApplicationTestCase
{
    public function testVeryHigh(): void
    {
        $minLevel = PopularityLevelEnum::VERY_HIGH;

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('perl')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('cobol')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('dart')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('ruby')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('kotlin')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('go')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('rust')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('swift')));

        $this->assertResultBetween(0.1, 0.2,
            $this->getRuleResult($minLevel, $this->getLanguageValue('r')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('php')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('c_sharp')));

        $this->assertResultBetween(0.3, 0.45,
            $this->getRuleResult($minLevel, $this->getLanguageValue('javascript')));

        $this->assertResultBetween(0.6, 0.7,
            $this->getRuleResult($minLevel, $this->getLanguageValue('java')));

        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('python')));
    }

    public function testHigh(): void
    {
        $minLevel = PopularityLevelEnum::HIGH;

        $this->assertResultBetween(0.02, 0.03,
            $this->getRuleResult($minLevel, $this->getLanguageValue('perl')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('cobol')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('dart')));

        $this->assertResultBetween(0.01, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('ruby')));

        $this->assertResultBetween(0.1, 0.2,
            $this->getRuleResult($minLevel, $this->getLanguageValue('kotlin')));

        $this->assertResultBetween(0.1, 0.2,
            $this->getRuleResult($minLevel, $this->getLanguageValue('go')));

        $this->assertResultBetween(0.1, 0.2,
            $this->getRuleResult($minLevel, $this->getLanguageValue('rust')));

        $this->assertResultBetween(0.1, 0.2,
            $this->getRuleResult($minLevel, $this->getLanguageValue('swift')));

        $this->assertResultBetween(0.3, 0.4,
            $this->getRuleResult($minLevel, $this->getLanguageValue('r')));

        $this->assertResultBetween(0.4, 0.5,
            $this->getRuleResult($minLevel, $this->getLanguageValue('php')));

        $this->assertResultBetween(0.5, 0.6,
            $this->getRuleResult($minLevel, $this->getLanguageValue('c_sharp')));

        $this->assertResultBetween(0.7, 0.85,
            $this->getRuleResult($minLevel, $this->getLanguageValue('javascript')));

        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('java')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('python')));
    }

    public function testMedium(): void
    {
        $minLevel = PopularityLevelEnum::MEDIUM;

        $this->assertResultBetween(0.04, 0.05,
            $this->getRuleResult($minLevel, $this->getLanguageValue('perl')));

        $this->assertResultBetween(0.04, 0.15,
            $this->getRuleResult($minLevel, $this->getLanguageValue('cobol')));

        $this->assertResultBetween(0.04, 0.15,
            $this->getRuleResult($minLevel, $this->getLanguageValue('dart')));

        $this->assertResultBetween(0.04, 0.15,
            $this->getRuleResult($minLevel, $this->getLanguageValue('ruby')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('kotlin')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('go')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('rust')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('swift')));

        $this->assertResultBetween(0.45, 0.6,
            $this->getRuleResult($minLevel, $this->getLanguageValue('r')));

        $this->assertResultBetween(0.6, 0.7,
            $this->getRuleResult($minLevel, $this->getLanguageValue('php')));

        $this->assertResultBetween(0.8, 0.9,
            $this->getRuleResult($minLevel, $this->getLanguageValue('c_sharp')));

        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('javascript')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('java')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('python')));
    }

    public function testLow(): void
    {
        $minLevel = PopularityLevelEnum::LOW;

        $this->assertResultBetween(0.08, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('perl')));

        $this->assertResultBetween(0.08, 0.1,
            $this->getRuleResult($minLevel, $this->getLanguageValue('cobol')));

        $this->assertResultBetween(0.15, 0.25,
            $this->getRuleResult($minLevel, $this->getLanguageValue('dart')));

        $this->assertResultBetween(0.2, 0.3,
            $this->getRuleResult($minLevel, $this->getLanguageValue('ruby')));

        $this->assertResultBetween(0.4, 0.5,
            $this->getRuleResult($minLevel, $this->getLanguageValue('kotlin')));

        $this->assertResultBetween(0.4, 0.55,
            $this->getRuleResult($minLevel, $this->getLanguageValue('go')));

        $this->assertResultBetween(0.45, 0.6,
            $this->getRuleResult($minLevel, $this->getLanguageValue('rust')));

        $this->assertResultBetween(0.45, 0.6,
            $this->getRuleResult($minLevel, $this->getLanguageValue('swift')));

        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('r')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('php')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('c_sharp')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('javascript')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('java')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('python')));
    }

    public function testVeryLow(): void
    {
        $minLevel = PopularityLevelEnum::VERY_LOW;

        $this->assertResultBetween(0.3, 0.4,
            $this->getRuleResult($minLevel, $this->getLanguageValue('perl')));

        $this->assertResultBetween(0.3, 0.45,
            $this->getRuleResult($minLevel, $this->getLanguageValue('cobol')));

        $this->assertResultBetween(0.75, 0.85,
            $this->getRuleResult($minLevel, $this->getLanguageValue('dart')));

        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('ruby')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('kotlin')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('go')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('rust')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('swift')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('r')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('php')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('c_sharp')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('javascript')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('java')));
        $this->assertEquals(1.0, $this->getRuleResult($minLevel, $this->getLanguageValue('python')));
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

    private function getRuleResult(PopularityLevelEnum $minLevel, float $popularity): float
    {
        $results = $this->createGenerator()->generate([
            $this->getFeature($minLevel)
        ], [
            new Item('test_lang', ['popularity' => $popularity])
        ]);

        return $results[0]->score;
    }

    private function createGenerator(): FuzzyResultGenerator
    {
        return new FuzzyResultGenerator();
    }

    private function getFeature(PopularityLevelEnum $minLevel): Feature
    {
        $rule = (new PopularityLevelRuleFactory())->create($minLevel);

        return (new FuzzyFeatureFactory())->create('popularity', $rule);
    }

    private function getLanguageValue(string $langId): float
    {
        /** @var MostPopularList $mostPopularList */
        $mostPopularList = $this->getMostPopular()->get($langId);
        return $mostPopularList->last()->percentageValue;
    }

    private function getMostPopular(): MostPopularHashMap
    {
        return $this->getService(GetMostPopularQuery::class)->getMostPopular();
    }
}

<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule;

use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyPointList;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyRule;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyTypeEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelPointEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelRuleFactoryInterface;

final class PopularityLevelRuleFactory implements PopularityLevelRuleFactoryInterface
{
    public function create(PopularityLevelEnum $minimumPopularityLevel): FuzzyRule
    {
        $values = $this->createValues($minimumPopularityLevel);

        return new FuzzyRule($values['type'], new FuzzyPointList($values['points']));
    }

    private function createValues(PopularityLevelEnum $minimumPopularityLevel): array
    {
        return match ($minimumPopularityLevel) {
            PopularityLevelEnum::VERY_HIGH => $this->createValue(PopularityLevelPointEnum::HIGH->value * 2),
            PopularityLevelEnum::HIGH => $this->createValue(PopularityLevelPointEnum::HIGH->value),
            PopularityLevelEnum::MEDIUM => $this->createValue(PopularityLevelPointEnum::MEDIUM->value),
            PopularityLevelEnum::LOW => $this->createValue(PopularityLevelPointEnum::LOW->value),
            PopularityLevelEnum::VERY_LOW => $this->createValue(PopularityLevelPointEnum::VERY_LOW->value),
        };
    }

    private function createValue(float $maxValue): array
    {
        return [
            'type' => FuzzyTypeEnum::TRAPMF,
            'points' =>  [0.0, $maxValue, 100.0 , 101.0],
        ];
    }
}

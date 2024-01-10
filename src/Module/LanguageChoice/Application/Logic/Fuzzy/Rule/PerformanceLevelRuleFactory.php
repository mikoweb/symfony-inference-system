<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule;

use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyPointList;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyRule;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyTypeEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelRuleFactoryInterface;
use App\Module\LanguageChoice\Domain\Fuzzy\SpeedComparisonPointEnum;

final class PerformanceLevelRuleFactory implements PerformanceLevelRuleFactoryInterface
{
    public function create(PerformanceLevelEnum $minimumPerformanceLevel): FuzzyRule
    {
        $values = $this->createValues($minimumPerformanceLevel);

        return new FuzzyRule($values['type'], new FuzzyPointList($values['points']));
    }

    private function createValues(PerformanceLevelEnum $minimumPerformanceLevel): array
    {
        return match ($minimumPerformanceLevel) {
            PerformanceLevelEnum::VERY_HIGH => [
                'type' => FuzzyTypeEnum::TRAPMF,
                'points' =>  [
                    $this->transformValue(SpeedComparisonPointEnum::VERY_HIGH->value * 3),
                    -65.0, 0.0, 1.0,
                ],
            ],
            PerformanceLevelEnum::HIGH => [
                'type' => FuzzyTypeEnum::TRAPMF,
                'points' =>  [
                    $this->transformValue(SpeedComparisonPointEnum::MEDIUM->value),
                    $this->transformValue(SpeedComparisonPointEnum::VERY_HIGH->value),
                    0.0, 1.0,
                ],
            ],
            PerformanceLevelEnum::MEDIUM => [
                'type' => FuzzyTypeEnum::TRAPMF,
                'points' =>  [
                    $this->transformValue(SpeedComparisonPointEnum::MEDIUM->value),
                    $this->transformValue(SpeedComparisonPointEnum::HIGH->value),
                    0.0, 1.0,
                ],
            ],
            PerformanceLevelEnum::LOW => [
                'type' => FuzzyTypeEnum::TRAPMF,
                'points' =>  [
                    $this->transformValue(SpeedComparisonPointEnum::LOW->value * 3),
                    $this->transformValue(SpeedComparisonPointEnum::HIGH->value),
                    0.0, 1.0,
                ],
            ],
            PerformanceLevelEnum::VERY_LOW => [
                'type' => FuzzyTypeEnum::TRAPMF,
                'points' =>  [
                    $this->transformValue(SpeedComparisonPointEnum::LOW->value * 4),
                    $this->transformValue(SpeedComparisonPointEnum::MEDIUM->value),
                    0.0, 1.0,
                ],
            ],
        };
    }

    private function transformValue(float $value): float
    {
        return -$value;
    }
}

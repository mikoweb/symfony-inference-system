<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy;

use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyRule;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyTypeEnum;
use ketili\Feature;
use ketili\membership\polygon\Trapmf;
use ketili\membership\polygon\Trimf;
use ketili\membership\sigmoid\SNonLinear;
use ketili\membership\Threshold;

final class FuzzyFeatureFactory
{
    public function create(string $identifier, FuzzyRule $rule, float $weight = 1.0): Feature
    {
        if ($rule->type === FuzzyTypeEnum::CUSTOM) {
            $feature = new Feature($identifier, new CustomFunction($rule->customFunction));
            $feature->set_weight($weight);

            return $feature;
        }

        $args = $rule->points->toArray();
        $function = match ($rule->type) {
            FuzzyTypeEnum::TRIMF => new Trimf(...$args),
            FuzzyTypeEnum::TRAPMF => new Trapmf(...$args),
            FuzzyTypeEnum::SIGMOID => new SNonLinear(...$args),
            FuzzyTypeEnum::THRESHOLD => new Threshold(...$args),
            default => new Trimf(...$args),
        };

        $feature = new Feature($identifier, $function);
        $feature->set_weight($weight);

        return $feature;
    }
}

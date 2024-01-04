<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule;

use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyPointList;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyRule;
use App\Module\LanguageChoice\Domain\Fuzzy\FuzzyTypeEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\UserExperienceLevelRuleFactoryInterface;

final class UserExperienceLevelRuleFactory implements UserExperienceLevelRuleFactoryInterface
{
    public function create(): FuzzyRule
    {
        return new FuzzyRule(FuzzyTypeEnum::TRIMF, new FuzzyPointList([0.0, 100.0, 101.0]));
    }
}

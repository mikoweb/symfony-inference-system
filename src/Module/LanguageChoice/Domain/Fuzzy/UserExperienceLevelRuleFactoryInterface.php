<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

interface UserExperienceLevelRuleFactoryInterface
{
    public function create(): FuzzyRule;
}

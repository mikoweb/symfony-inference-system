<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategy;

use App\Module\LanguageChoice\Application\Logic\Engine\FeatureStrategyInterface;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyFeatureFactory;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\Rule\UserExperienceLevelRuleFactory;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;

final class UserExperienceFeatureStrategy implements FeatureStrategyInterface
{
    public function isSupports(LanguageFilter $filter): bool
    {
        return !is_null($filter->userExperienceFilterItemList);
    }

    public function createFeature(LanguageFilter $filter): Feature
    {
        $rule = (new UserExperienceLevelRuleFactory())->create();

        return (new FuzzyFeatureFactory())->create('user_experience', $rule);
    }
}

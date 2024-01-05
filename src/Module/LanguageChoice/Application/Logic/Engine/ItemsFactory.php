<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine;

use App\Module\Language\Infrastructure\Query\FindLanguagesByUsageQuery;
use App\Module\Language\Infrastructure\Query\GetLanguagesQuery;
use App\Module\Language\Infrastructure\Query\GetMostPopularQuery;
use App\Module\Language\Infrastructure\Query\GetSpeedComparisonQuery;
use App\Module\LanguageChoice\Domain\Fuzzy\SpeedComparisonPointEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\UserExperienceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;
use ketili\Item;

final readonly class ItemsFactory
{
    public function __construct(
        private GetLanguagesQuery $getLanguagesQuery,
        private FindLanguagesByUsageQuery $findLanguagesByUsageQuery,
        private GetSpeedComparisonQuery $getSpeedComparisonQuery,
        private GetMostPopularQuery $getMostPopularQuery
    ) {}

    /**
     * @param LanguageFilter $filter
     * @param Feature[] $features
     * @return Item[]
     */
    public function createItems(LanguageFilter $filter, array $features): array
    {
        $items = [];
        $languages = $this->getLanguagesQuery->getLanguages();
        $speedComparison = $this->getSpeedComparisonQuery->getSpeedComparison();
        $mostPopularQuery = $this->getMostPopularQuery->getMostPopular();

        if (!is_null($filter->usage)) {
            $languages = $this->findLanguagesByUsageQuery->findByUsage($languages, $filter->usage);
        }

        foreach ($languages as $language) {
            $id = $language->id;
            $userExperienceEnum = $this->getUserExperienceEnum($filter, $id);
            $values = [];

            if ($this->hasFeature($features, 'performance')) {
                $values['performance'] = $speedComparison->containsKey($id)
                    ? -$speedComparison->get($id)->median : -SpeedComparisonPointEnum::VERY_LOW->value;
            }

            if ($this->hasFeature($features, 'popularity')) {
                $values['popularity'] = $mostPopularQuery->containsKey($id)
                    ? ($mostPopularQuery->get($id)->last()?->percentageValue ?? 0) : 0;
            }

            if ($this->hasFeature($features, 'user_experience')) {
                $values['user_experience'] = $userExperienceEnum->value;
            }

            $items[] = new Item($id, $values);
        }

        return $items;
    }

    /**
     * @param Feature[] $features
     * @param string $name
     * @return bool
     */
    private function hasFeature(array $features, string $name): bool
    {
        return !empty(array_filter($features, fn(Feature $feature) => $feature->identifier === $name));
    }

    private function getUserExperienceEnum(LanguageFilter $filter, string $langId): UserExperienceLevelEnum
    {
        if (!is_null($filter->userExperienceFilterItemList)) {
            $userExperience = $filter->userExperienceFilterItemList->where('langId', $langId);
            return !$userExperience->isEmpty()
                ? UserExperienceLevelEnum::fromString($userExperience->first()->levelName)
                : UserExperienceLevelEnum::NONE;
        } else {
            return UserExperienceLevelEnum::NONE;
        }
    }
}

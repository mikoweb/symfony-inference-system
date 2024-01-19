<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine;

use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\MostPopular\MostPopularList;
use App\Module\Language\Domain\Query\GetLanguagesQueryInterface;
use App\Module\Language\Domain\Query\GetMostPopularQueryInterface;
use App\Module\Language\Domain\Query\GetPopularityForecastQueryInterface;
use App\Module\Language\Domain\Query\GetSpeedComparisonQueryInterface;
use App\Module\Language\Infrastructure\Query\Enum\FindModeEnum;
use App\Module\Language\Infrastructure\Query\FindLanguagesByFeaturesQuery;
use App\Module\Language\Infrastructure\Query\FindLanguagesByUsageQuery;
use App\Module\LanguageChoice\Domain\Fuzzy\SpeedComparisonPointEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\UserExperienceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;
use ketili\Item;

final readonly class ItemsFactory
{
    public function __construct(
        private GetLanguagesQueryInterface $getLanguagesQuery,
        private FindLanguagesByUsageQuery $findLanguagesByUsageQuery,
        private FindLanguagesByFeaturesQuery $findLanguagesByFeaturesQuery,
        private GetSpeedComparisonQueryInterface $getSpeedComparisonQuery,
        private GetMostPopularQueryInterface $getMostPopularQuery,
        private GetPopularityForecastQueryInterface $getPopularityForecastQuery,
    ) {}

    /**
     * @param Feature[] $features
     *
     * @return Item[]
     */
    public function createItems(LanguageFilter $filter, array $features): array
    {
        $items = [];
        $languages = $this->getLanguagesQuery->getLanguages();
        $speedComparison = $this->getSpeedComparisonQuery->getSpeedComparison();

        if (!is_null($filter->usage)) {
            $languages = $this->findLanguagesByUsageQuery->findByUsage(
                $languages,
                $filter->usage,
                FindModeEnum::from($filter->usageMode->value)
            );
        }

        if (!is_null($filter->features)) {
            $languages = $this->findLanguagesByFeaturesQuery->findByFeatures(
                $languages,
                $filter->features,
                FindModeEnum::from($filter->featuresMode->value)
            );
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
                $values['popularity'] = $this->getPopularityValue($filter, $id);
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
     */
    private function hasFeature(array $features, string $name): bool
    {
        return !empty(array_filter($features, fn (Feature $feature) => $feature->identifier === $name));
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

    private function getMostPopular(LanguageFilter $filter): MostPopularHashMap
    {
        return is_null($filter->popularityForecastYear)
            ? $this->getMostPopularQuery->getMostPopular()
            : $this->getPopularityForecastQuery->getForecast();
    }

    private function getPopularityValue(
        LanguageFilter $filter,
        string $langId,
    ): float {
        $mostPopular = $this->getMostPopular($filter);

        if (!$mostPopular->containsKey($langId)) {
            return 0.0;
        }

        /** @var MostPopularList $list */
        $list = $mostPopular->get($langId);

        return is_null($filter->popularityForecastYear)
            ? $list->last()?->percentageValue ?? 0.0
            : $list->where('year', $filter->popularityForecastYear)[0]?->percentageValue ?? 0.0;
    }
}

<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;
use App\Module\Language\Infrastructure\Query\Enum\FindModeEnum;

final class FindLanguagesByFeaturesQuery
{
    /**
     * @param ProgrammingLanguagesDataset|LanguageData[] $dataset
     *
     * @return ProgrammingLanguagesDataset|LanguageData[]
     */
    public function findByFeatures(
        ProgrammingLanguagesDataset $dataset,
        LanguageFeatureList $features,
        FindModeEnum $findMode,
    ): ProgrammingLanguagesDataset {
        return match ($findMode) {
            FindModeEnum::AND => $dataset->filterSubCollectionAnd('features', $features->toArray()),
            FindModeEnum::OR => $dataset->filterSubCollectionOr('features', $features->toArray())
        };
    }
}

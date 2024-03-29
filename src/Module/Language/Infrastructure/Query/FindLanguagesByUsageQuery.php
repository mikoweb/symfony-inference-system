<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;
use App\Module\Language\Infrastructure\Query\Enum\FindModeEnum;

final class FindLanguagesByUsageQuery
{
    /**
     * @param ProgrammingLanguagesDataset|LanguageData[] $dataset
     *
     * @return ProgrammingLanguagesDataset|LanguageData[]
     */
    public function findByUsage(
        ProgrammingLanguagesDataset $dataset,
        LanguageUsageList $usage,
        FindModeEnum $findMode,
    ): ProgrammingLanguagesDataset {
        return match ($findMode) {
            FindModeEnum::AND => $dataset->filterSubCollectionAnd('usage', $usage->toArray()),
            FindModeEnum::OR => $dataset->filterSubCollectionOr('usage', $usage->toArray())
        };
    }
}

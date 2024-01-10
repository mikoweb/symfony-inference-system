<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;

class FindLanguagesByUsageQuery
{
    /**
     * @param ProgrammingLanguagesDataset|LanguageData[] $dataset
     * @param LanguageUsageList $usage
     * @return ProgrammingLanguagesDataset|LanguageData[]
     */
    public function findByUsage(
        ProgrammingLanguagesDataset $dataset,
        LanguageUsageList $usage
    ): ProgrammingLanguagesDataset {
        return $dataset->filter(function (LanguageData $data) use ($usage) {
            $match = false;

            foreach ($usage as $enum) {
                if (in_array($enum, $data->usage->toArray())) {
                    $match = true;
                    break;
                }
            }

            return $match;
        });
    }
}

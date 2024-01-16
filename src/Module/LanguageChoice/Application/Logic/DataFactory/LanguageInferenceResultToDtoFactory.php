<?php

namespace App\Module\LanguageChoice\Application\Logic\DataFactory;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;
use App\Module\Language\Domain\Query\GetLanguagesQueryInterface;
use App\Module\LanguageChoice\Domain\Dto\LanguageInferenceResultDto;
use App\Module\LanguageChoice\Domain\LanguageInferenceResult;

final class LanguageInferenceResultToDtoFactory
{
    private static ?ProgrammingLanguagesDataset $languages = null;

    public function __construct(
        private readonly GetLanguagesQueryInterface $getLanguagesQuery
    ) {}

    public function createDto(LanguageInferenceResult $result): LanguageInferenceResultDto
    {
        $language = $this->getLanguage($result->langId);

        return new LanguageInferenceResultDto(
            langId: $result->langId,
            score: $result->score,
            name: $language->name ?? '',
            usage: array_map(
                fn (LanguageUsageEnum $usage) => $usage->value,
                $language?->usage->toArray() ?? []
            ),
            features: array_map(
                fn (LanguageFeatureEnum $feature) => $feature->value,
                $language?->features->toArray() ?? []
            ),
        );
    }

    private function getLanguage(string $langId): ?LanguageData
    {
        return $this->getLanguages()->findLanguageById($langId);
    }

    private function getLanguages(): ProgrammingLanguagesDataset
    {
        if (is_null(self::$languages)) {
            self::$languages = $this->getLanguagesQuery->getLanguages();
        }

        return self::$languages;
    }
}

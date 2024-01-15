<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;
use App\Module\Language\Domain\Query\GetLanguagesQueryInterface;
use App\Module\Language\Infrastructure\Reader\ProgrammingLanguagesDatasetReader;

final class GetLanguagesQuery implements GetLanguagesQueryInterface
{
    private static ?ProgrammingLanguagesDataset $languages = null;

    public function __construct(
        private readonly ProgrammingLanguagesDatasetReader $programmingLanguagesDatasetReader
    ) {}

    public function getLanguages(): ProgrammingLanguagesDataset
    {
        if (is_null(self::$languages)) {
            self::$languages = $this->programmingLanguagesDatasetReader->loadDataset();
        }

        return self::$languages;
    }
}

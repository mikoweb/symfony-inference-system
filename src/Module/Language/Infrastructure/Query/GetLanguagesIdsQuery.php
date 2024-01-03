<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\Query\GetLanguagesIdsQueryInterface;
use League\Csv\Exception;
use League\Csv\UnavailableStream;

final class GetLanguagesIdsQuery implements GetLanguagesIdsQueryInterface
{
    private static ?array $ids = null;

    public function __construct(
        private readonly GetLanguagesQuery $getLanguagesQuery
    ) {}

    /**
     * @throws UnavailableStream
     * @throws Exception
     *
     * @return string[]
     */
    public function getIds(): array
    {
        if (is_null(self::$ids)) {
            $languages = $this->getLanguagesQuery->getLanguages();
            self::$ids = array_map(fn(LanguageData $data) => $data->id, $languages->toArray());
        }

        return self::$ids;
    }
}

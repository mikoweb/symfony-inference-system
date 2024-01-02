<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use Ramsey\Collection\AbstractCollection;

final class ProgrammingLanguagesDataset extends AbstractCollection
{
    public function getType(): string
    {
        return LanguageData::class;
    }
}

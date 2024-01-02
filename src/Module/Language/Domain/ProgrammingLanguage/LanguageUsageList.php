<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use Ramsey\Collection\AbstractCollection;

final class LanguageUsageList extends AbstractCollection
{
    public function getType(): string
    {
        return LanguageUsageEnum::class;
    }
}

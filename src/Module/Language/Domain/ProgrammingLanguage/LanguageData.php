<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

final readonly class LanguageData
{
    public function __construct(
        public string $id,
        public string $name,
        // TODO
    ) {}
}

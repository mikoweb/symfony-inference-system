<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

interface LanguageIdFactoryInterface
{
    public function createId(string $name): string;
}

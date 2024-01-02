<?php

namespace App\Module\Language\Application\Logic\ProgrammingLanguage;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageIdFactoryInterface;
use function Symfony\Component\String\u;

final class LanguageIdFactory implements LanguageIdFactoryInterface
{
    public function createId(string $name): string
    {
        return u($name)->lower()->snake();
    }
}

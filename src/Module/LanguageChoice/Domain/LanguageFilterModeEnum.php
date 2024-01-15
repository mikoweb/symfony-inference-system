<?php

namespace App\Module\LanguageChoice\Domain;

use App\Module\Core\Domain\Enum\GetEnumAllowedValuesTrait;

enum LanguageFilterModeEnum: string
{
    use GetEnumAllowedValuesTrait;

    case AND = 'and';
    case OR = 'or';
}

<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use App\Module\Core\Domain\Enum\GetEnumAllowedValuesTrait;

enum LanguageFeatureEnum: string
{
    use GetEnumAllowedValuesTrait;

    case OBJECT_ORIENTED = 'object_oriented';
    case FUNCTIONAL = 'functional';
    case PROCEDURAL = 'procedural';
    case REFLECTIVE = 'reflective';
    case EVENT_DRIVEN = 'event_driven';
}

<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

enum LanguageFeatureEnum: string
{
    case OBJECT_ORIENTED = 'object_oriented';
    case FUNCTIONAL = 'functional';
    case PROCEDURAL = 'procedural';
    case REFLECTIVE = 'reflective';
    case EVENT_DRIVEN = 'event_driven';
}

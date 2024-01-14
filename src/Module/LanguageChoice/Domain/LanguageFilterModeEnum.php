<?php

namespace App\Module\LanguageChoice\Domain;

enum LanguageFilterModeEnum: string
{
    case AND = 'and';
    case OR = 'or';
}

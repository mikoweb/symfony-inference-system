<?php

namespace App\Module\Language\Infrastructure\Query\Enum;

enum FindModeEnum: string
{
    case AND = 'and';
    case OR = 'or';
}

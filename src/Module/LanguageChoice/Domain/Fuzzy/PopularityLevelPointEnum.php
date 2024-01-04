<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

use App\Module\Core\Domain\Enum\EnumFromStringTrait;

enum PopularityLevelPointEnum: int
{
    use EnumFromStringTrait;

    case VERY_HIGH = 100;
    case HIGH = 12;
    case MEDIUM = 8;
    case LOW = 4;
    case VERY_LOW = 1;
}

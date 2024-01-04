<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

use App\Module\Core\Domain\Enum\EnumFromStringTrait;

enum PopularityLevelEnum: int
{
    use EnumFromStringTrait;

    case VERY_HIGH = 400;
    case HIGH = 300;
    case MEDIUM = 200;
    case LOW = 100;
    case VERY_LOW = 0;
}

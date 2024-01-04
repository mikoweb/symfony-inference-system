<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

use App\Module\Core\Domain\Enum\EnumFromStringTrait;

enum SpeedComparisonPointEnum: int
{
    use EnumFromStringTrait;

    case VERY_HIGH = 100;
    case HIGH = 500;
    case MEDIUM = 1000;
    case LOW = 3000;
    case VERY_LOW = 1000000000;
}

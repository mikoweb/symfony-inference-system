<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

use App\Module\Core\Domain\Enum\EnumFromStringTrait;

enum UserExperienceLevelEnum: int
{
    use EnumFromStringTrait;

    case VERY_HIGH = 100;
    case HIGH = 80;
    case MEDIUM = 60;
    case LOW = 35;
    case VERY_LOW = 15;
    case NONE = 0;
}

<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

enum SpeedComparisonPointEnum: int
{
    case VERY_HIGH = 100;
    case HIGH = 500;
    case MEDIUM = 1000;
    case LOW = 3000;
    case VERY_LOW = 1000000000;

    public static function fromString(string $name): ?self
    {
        $find = current(array_filter(self::cases(), fn(SpeedComparisonPointEnum $enum) => $enum->name === $name));

        return $find ?: null;
    }
}

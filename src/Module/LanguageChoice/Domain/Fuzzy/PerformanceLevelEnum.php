<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

enum PerformanceLevelEnum: int
{
    case VERY_HIGH = 400;
    case HIGH = 300;
    case MEDIUM = 200;
    case LOW = 100;
    case VERY_LOW = 0;

    public static function fromString(string $name): ?self
    {
        $find = current(array_filter(self::cases(), fn(PerformanceLevelEnum $enum) => $enum->name === $name));

        return $find ?: null;
    }

    public static function fromSpeedComparisonValue(float $value): self
    {
        if ($value < 100) {
            return self::VERY_HIGH;
        } elseif ($value < 500) {
            return self::HIGH;
        } elseif ($value < 1000) {
            return self::MEDIUM;
        } elseif ($value < 3000) {
            return self::LOW;
        } else {
            return self::VERY_LOW;
        }
    }
}

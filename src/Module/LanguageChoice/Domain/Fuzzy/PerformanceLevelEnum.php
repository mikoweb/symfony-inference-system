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
        if ($value < SpeedComparisonPointEnum::VERY_HIGH->value) {
            return self::VERY_HIGH;
        } elseif ($value < SpeedComparisonPointEnum::HIGH->value) {
            return self::HIGH;
        } elseif ($value < SpeedComparisonPointEnum::MEDIUM->value) {
            return self::MEDIUM;
        } elseif ($value < SpeedComparisonPointEnum::LOW->value) {
            return self::LOW;
        } else {
            return self::VERY_LOW;
        }
    }

    public function toSpeedComparisonPoint(): SpeedComparisonPointEnum
    {
        return SpeedComparisonPointEnum::fromString($this->name);
    }
}

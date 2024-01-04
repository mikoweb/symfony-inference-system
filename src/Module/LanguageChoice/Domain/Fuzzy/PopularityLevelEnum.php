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

    public static function fromPopularityValue(float $value): self
    {
        if ($value < PopularityLevelPointEnum::VERY_LOW->value) {
            return self::VERY_LOW;
        } elseif ($value < PopularityLevelPointEnum::LOW->value) {
            return self::LOW;
        } elseif ($value < PopularityLevelPointEnum::MEDIUM->value) {
            return self::MEDIUM;
        } elseif ($value < PopularityLevelPointEnum::HIGH->value) {
            return self::HIGH;
        } else {
            return self::VERY_HIGH;
        }
    }

    public function toPointEnum(): PopularityLevelPointEnum
    {
        return PopularityLevelPointEnum::fromString($this->name);
    }
}

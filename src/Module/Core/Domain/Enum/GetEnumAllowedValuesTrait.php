<?php

namespace App\Module\Core\Domain\Enum;

use UnitEnum;

trait GetEnumAllowedValuesTrait
{
    public static function getAllowedValues(): array
    {
        return array_map(fn (UnitEnum $enum) => $enum->value, self::cases());
    }
}

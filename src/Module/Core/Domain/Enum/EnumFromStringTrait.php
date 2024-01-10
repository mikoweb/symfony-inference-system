<?php

namespace App\Module\Core\Domain\Enum;

trait EnumFromStringTrait
{
    public static function fromString(string $name): ?self
    {
        $find = current(array_filter(self::cases(), fn ($enum) => $enum->name === $name));

        return $find ?: null;
    }
}

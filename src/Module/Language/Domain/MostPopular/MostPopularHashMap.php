<?php

namespace App\Module\Language\Domain\MostPopular;

use Ramsey\Collection\Map\AbstractTypedMap;

final class MostPopularHashMap extends AbstractTypedMap
{
    public function getKeyType(): string
    {
        return 'string';
    }

    public function getValueType(): string
    {
        return MostPopularList::class;
    }

    public function getMaxYear(): int
    {
        $list = $this->getFirstList();

        return is_null($list) ? 0 : $list->reduce(
            fn (int $max, MostPopularValue $value) => max($value->year, $max),
            $list->first()->year
        );
    }

    public function getMinYear(): int
    {
        $list = $this->getFirstList();

        return is_null($list) ? 0 : $list->reduce(
            fn (int $min, MostPopularValue $value) => min($value->year, $min),
            $list->first()->year
        );
    }

    private function getFirstList(): ?MostPopularList
    {
        return $this->isEmpty() ? null : array_values($this->toArray())[0];
    }
}

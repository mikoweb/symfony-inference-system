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
}

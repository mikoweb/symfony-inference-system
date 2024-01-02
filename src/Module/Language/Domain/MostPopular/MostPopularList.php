<?php

namespace App\Module\Language\Domain\MostPopular;

use Ramsey\Collection\AbstractCollection;

final class MostPopularList extends AbstractCollection
{
    public function getType(): string
    {
        return MostPopularValue::class;
    }
}

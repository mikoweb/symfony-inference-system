<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

use Ramsey\Collection\AbstractCollection;

final class FuzzyPointList extends AbstractCollection
{
    public function getType(): string
    {
        return 'float';
    }
}

<?php

namespace App\Module\LanguageChoice\Domain\Filter;

use Ramsey\Collection\AbstractCollection;

final class UserExperienceFilterItemList extends AbstractCollection
{
    public function getType(): string
    {
        return UserExperienceFilterItem::class;
    }
}

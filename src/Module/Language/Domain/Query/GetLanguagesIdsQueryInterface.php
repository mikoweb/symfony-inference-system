<?php

namespace App\Module\Language\Domain\Query;

interface GetLanguagesIdsQueryInterface
{
    /**
     * @return string[]
     */
    public function getIds(): array;
}

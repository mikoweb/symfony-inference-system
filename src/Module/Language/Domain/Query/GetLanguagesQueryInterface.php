<?php

namespace App\Module\Language\Domain\Query;

use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;

interface GetLanguagesQueryInterface
{
    public function getLanguages(): ProgrammingLanguagesDataset;
}

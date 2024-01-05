<?php

namespace App\Module\LanguageChoice\Domain;

use Ramsey\Collection\AbstractCollection;

final class LanguageInferenceResultList extends AbstractCollection
{
    public function getType(): string
    {
        return LanguageInferenceResult::class;
    }
}

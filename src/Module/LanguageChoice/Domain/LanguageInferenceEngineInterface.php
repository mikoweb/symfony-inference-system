<?php

namespace App\Module\LanguageChoice\Domain;

interface LanguageInferenceEngineInterface
{
    public function createResults(LanguageFilter $filter): LanguageInferenceResultList;
}

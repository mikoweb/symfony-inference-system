<?php

namespace App\Module\LanguageChoice\Application\Logic\Engine;

use App\Module\LanguageChoice\Domain\LanguageFilter;
use ketili\Feature;

interface FeatureStrategyInterface
{
    public function isSupports(LanguageFilter $filter): bool;
    public function createFeature(LanguageFilter $filter): Feature;
}

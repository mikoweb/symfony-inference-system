<?php

namespace App\Module\LanguageChoice\Domain;

final readonly class LanguageInferenceResult
{
    public function __construct(
        public string $langId,
        public float $score,
    ) {}
}

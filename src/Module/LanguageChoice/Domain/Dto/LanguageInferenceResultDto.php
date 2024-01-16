<?php

namespace App\Module\LanguageChoice\Domain\Dto;

final readonly class LanguageInferenceResultDto
{
    public function __construct(
        public string $langId,
        public float $score,
        public string $name,

        /**
         * @var string[]
         */
        public array $usage,

        /**
         * @var string[]
         */
        public array $features,
    ) {}
}

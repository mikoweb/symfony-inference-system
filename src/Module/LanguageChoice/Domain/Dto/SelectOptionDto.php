<?php

namespace App\Module\LanguageChoice\Domain\Dto;

final readonly class SelectOptionDto
{
    public function __construct(
        public string|int $value,
        public string $label
    ) {}
}

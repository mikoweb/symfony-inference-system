<?php

namespace App\Module\LanguageChoice\Domain\Dto;

final readonly class PackageDto
{
    public function __construct(
        public string $name,
        public LanguageFilterDto $filter,
    ) {}
}

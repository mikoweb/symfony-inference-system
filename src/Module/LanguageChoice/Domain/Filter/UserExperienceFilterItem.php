<?php

namespace App\Module\LanguageChoice\Domain\Filter;

final readonly class UserExperienceFilterItem
{
    public function __construct(
        public string $langId,
        public string $levelName,
    ) {}
}

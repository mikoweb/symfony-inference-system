<?php

namespace App\Module\LanguageChoice\Domain\Filter;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class UserExperienceFilterItem
{
    public function __construct(
        #[Assert\NotBlank]
        public string $langId,

        #[Assert\NotBlank]
        public string $levelName,
    ) {}
}

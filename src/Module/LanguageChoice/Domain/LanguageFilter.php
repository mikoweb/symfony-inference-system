<?php

namespace App\Module\LanguageChoice\Domain;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;

final readonly class LanguageFilter
{
    public function __construct(
        /**
         * @var LanguageUsageEnum[]|null
         */
        public ?array $usage = null,
        public ?PerformanceLevelEnum $minimumPerformanceLevel = null
    ) {}
}

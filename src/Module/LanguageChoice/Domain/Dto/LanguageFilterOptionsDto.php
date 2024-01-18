<?php

namespace App\Module\LanguageChoice\Domain\Dto;

final readonly class LanguageFilterOptionsDto
{
    public function __construct(
        /**
         * @var SelectOptionDto[]
         */
        public array $usageOptions,

        /**
         * @var SelectOptionDto[]
         */
        public array $usageModeOptions,

        /**
         * @var SelectOptionDto[]
         */
        public array $featuresOptions,

        /**
         * @var SelectOptionDto[]
         */
        public array $featuresModeOptions,

        /**
         * @var SelectOptionDto[]
         */
        public array $minimumPerformanceLevelOptions,

        /**
         * @var SelectOptionDto[]
         */
        public array $minimumPopularityLevelOptions,

        /**
         * @var SelectOptionDto[]
         */
        public array $userExperienceLevelOptions,

        /**
         * @var PackageDto[]
         */
        public array $filterPackages,
    ) {}
}

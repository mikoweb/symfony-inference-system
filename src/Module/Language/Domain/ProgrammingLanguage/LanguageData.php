<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

final readonly class LanguageData
{
    public LanguageFeatureList $features;

    public function __construct(
        public string $id,
        public string $name,
        public LanguageUsageList $usage,
        public bool $objectOriented,
        public bool $functional,
        public bool $procedural,
        public bool $reflective,
        public bool $eventDriven,
    ) {
        $this->features = LanguageFeatureList::createFromLanguageData($this);
    }
}

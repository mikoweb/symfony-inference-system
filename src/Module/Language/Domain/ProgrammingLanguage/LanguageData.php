<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use Symfony\Component\Serializer\Attribute\Ignore;

final readonly class LanguageData
{
    #[Ignore]
    public LanguageFeatureList $features;

    public function __construct(
        public string $id,
        public string $name,
        #[Ignore]
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

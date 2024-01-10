<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

interface LanguageUsageFactoryInterface
{
    /**
     * @param string[] $usage
     */
    public function createList(array $usage): LanguageUsageList;
}

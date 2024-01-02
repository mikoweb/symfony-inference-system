<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

interface LanguageUsageFactoryInterface
{
    /**
     * @param string[] $usage
     * @return LanguageUsageList
     */
    public function createList(array $usage): LanguageUsageList;
}

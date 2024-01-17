<?php

namespace App\Module\Language\Application\Logic\ProgrammingLanguage;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageFactoryInterface;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;

final class LanguageUsageFactory implements LanguageUsageFactoryInterface
{
    private const array MAP = [
        [['web'], LanguageUsageEnum::WEB],
        [['mobile'], LanguageUsageEnum::MOBILE],
        [['general'], LanguageUsageEnum::GENERAL],
        [['embedded'], LanguageUsageEnum::EMBEDDED],
        [['server'], LanguageUsageEnum::SERVER_SIDE],
        [['client'], LanguageUsageEnum::CLIENT_SIDE],
        [['business'], LanguageUsageEnum::BUSINESS],
        [['shell'], LanguageUsageEnum::SHELL],
        [['scripting', 'script'], LanguageUsageEnum::SCRIPTING],
        [['game'], LanguageUsageEnum::GAMES],
        [['artificial', 'ai'], LanguageUsageEnum::AI],
        [['database', 'db'], LanguageUsageEnum::DATABASES],
        [['scientific', 'science'], LanguageUsageEnum::SCIENTIFIC],
        [['statistic', 'stat'], LanguageUsageEnum::STATISTICS],
    ];

    public function createList(array $usage): LanguageUsageList
    {
        $list = new LanguageUsageList();

        foreach ($usage as $value) {
            $this->matchSingleUsage($list, strtolower($value));
        }

        return $list;
    }

    private function matchSingleUsage(LanguageUsageList $list, string $usage): void
    {
        foreach (self::MAP as $map) {
            if (!$list->contains($map[1]) && $this->valueContains($usage, $map[0])) {
                $list->add($map[1]);
            }
        }
    }

    private function valueContains(string $usage, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_contains($usage, $needle)) {
                return true;
            }
        }

        return false;
    }
}

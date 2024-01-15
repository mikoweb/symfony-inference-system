<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use App\Module\Core\Domain\Enum\GetEnumAllowedValuesTrait;

enum LanguageUsageEnum: string
{
    use GetEnumAllowedValuesTrait;

    case WEB = 'web';
    case MOBILE = 'mobile';
    case DESKTOP = 'desktop';
    case GENERAL = 'general';
    case EMBEDDED = 'embedded';
    case SERVER_SIDE = 'server_side';
    case CLIENT_SIDE = 'client_side';
    case BUSINESS = 'business';
    case SHELL = 'shell';
    case SCRIPTING = 'scripting';
    case GAMES = 'games';
    case AI = 'ai';
    case DATABASES = 'databases';
    case SCIENTITIFIC = 'scientific';
    case STATISTICS = 'statistics';
}

<?php

namespace App\Module\LanguageChoice\Domain\Filter;

enum FilterPackageKeyEnum: string
{
    case DATA_SCIENCE = 'data_science';
    case DESKTOP = 'desktop';
    case EMBEDDED = 'embedded';
    case MOBILE = 'mobile';
    case WEB = 'web';
}

<?php

namespace App\Module\LanguageChoice\Domain\Fuzzy;

enum FuzzyTypeEnum
{
    case TRIMF;
    case TRAPMF;
    case SIGMOID;
    case CUSTOM;
    case THRESHOLD;
}

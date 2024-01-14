<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use Ramsey\Collection\AbstractCollection;

use function Symfony\Component\String\u;

final class LanguageFeatureList extends AbstractCollection
{
    public function getType(): string
    {
        return LanguageFeatureEnum::class;
    }

    public static function createFromLanguageData(LanguageData $data): self
    {
        $list = new self();

        foreach (LanguageFeatureEnum::cases() as $case) {
            $property = u($case->value)->camel()->toString();

            if ($data->{$property}) {
                $list->add($case);
            }
        }

        return $list;
    }
}

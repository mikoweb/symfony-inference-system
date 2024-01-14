<?php

namespace App\Module\Language\Domain\ProgrammingLanguage;

use Ramsey\Collection\AbstractCollection;

final class ProgrammingLanguagesDataset extends AbstractCollection
{
    public function getType(): string
    {
        return LanguageData::class;
    }

    public function filterSubCollectionOr(string $subCollectionProperty, array $values): self
    {
        /** @var ProgrammingLanguagesDataset $data */
        $data = $this->filter(function (LanguageData $data) use ($subCollectionProperty, $values) {
            $match = false;
            $array = $data->{$subCollectionProperty}->toArray();

            foreach ($values as $value) {
                if (in_array($value, $array)) {
                    $match = true;
                    break;
                }
            }

            return $match;
        });

        return $data;
    }

    public function filterSubCollectionAnd(string $subCollectionProperty, array $values): self
    {
        /** @var ProgrammingLanguagesDataset $data */
        $data = $this->filter(function (LanguageData $data) use ($subCollectionProperty, $values) {
            $count = count($values);
            $match = $count > 0;
            $array = $data->{$subCollectionProperty}->toArray();
            $i = 0;

            while ($match && $i < $count) {
                $match = in_array($values[$i], $array);
                ++$i;
            }

            return $match;
        });

        return $data;
    }
}

<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy;

use ketili\aggregation\ArithmeticMean;
use ketili\Analyzer;
use ketili\Feature;
use ketili\Item;
use ketili\Result;
use Exception;

final class FuzzyResultGenerator
{
    /**
     * @param Feature[] $features
     * @param Item[] $valueItems
     * @return Result[]
     *
     * @throws Exception
     */
    public function generate(array $features, array $valueItems): array
    {
        $analyzer = new Analyzer($features, $valueItems, new ArithmeticMean());
        $analyzer->analyze();

        return $analyzer->sort() ?? [];
    }
}

<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy;

use ketili\aggregation\ArithmeticMean;
use Override;

class MeanFunction extends ArithmeticMean
{
    #[Override] public function call($array): float
    {
        $sum = (float) array_sum($array);

        if ($sum == 0) {
            return 0.0;
        }

        return parent::call($array);
    }
}

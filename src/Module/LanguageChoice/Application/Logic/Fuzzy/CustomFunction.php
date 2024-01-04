<?php

namespace App\Module\LanguageChoice\Application\Logic\Fuzzy;

use Closure;
use ketili\membership\MembershipFunction;

final class CustomFunction implements MembershipFunction
{
    public function __construct(
        public Closure $customFunction
    ) {}

    public function call($x): float
    {
        return $this->customFunction->call($this, $x);
    }
}

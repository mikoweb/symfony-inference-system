<?php

namespace App\Tests;

use App\Tests\Helper\Traits\ServiceableTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractApplicationTestCase extends KernelTestCase
{
    use ServiceableTrait;

    protected function setUp(): void
    {
        self::bootKernel();
    }
}

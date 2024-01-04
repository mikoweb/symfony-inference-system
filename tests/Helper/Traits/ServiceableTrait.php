<?php

namespace App\Tests\Helper\Traits;

use Symfony\Component\DependencyInjection\ContainerInterface;

trait ServiceableTrait
{
    public function getService(
        string $id,
        int $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE
    ): ?object
    {
        return static::getContainer()->get($id, $invalidBehavior);
    }
}

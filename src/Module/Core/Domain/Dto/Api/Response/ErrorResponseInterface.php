<?php

namespace App\Module\Core\Domain\Dto\Api\Response;

interface ErrorResponseInterface
{
    public function getError(): string;
    public function setError(string $error): static;
}

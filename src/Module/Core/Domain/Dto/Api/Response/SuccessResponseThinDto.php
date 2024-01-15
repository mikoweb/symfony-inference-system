<?php

namespace App\Module\Core\Domain\Dto\Api\Response;

abstract class SuccessResponseThinDto
{
    public function __construct(
        private string $message
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }
}

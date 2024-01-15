<?php

namespace App\Module\Core\Domain\Dto\Api\Response;

interface SuccessResponseInterface
{
    public function getResponseData(): ?object;
    public function setResponseData(?object $responseData): static;
    public function getMessage(): string;
    public function setMessage(string $message): static;
}

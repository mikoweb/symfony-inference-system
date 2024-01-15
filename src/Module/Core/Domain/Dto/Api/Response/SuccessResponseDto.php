<?php

namespace App\Module\Core\Domain\Dto\Api\Response;

class SuccessResponseDto extends SuccessResponseThinDto implements SuccessResponseInterface
{
    public function __construct(
        string $message,
        private ?object $responseData = null,
    ) {
        parent::__construct($message);
    }

    public function getResponseData(): ?object
    {
        return $this->responseData;
    }

    public function setResponseData(?object $responseData): static
    {
        $this->responseData = $responseData;

        return $this;
    }
}

<?php

namespace App\Module\Core\Application\Api\Controller\Trait;

use App\Module\Core\Domain\Dto\Api\Response\SuccessResponseDto;
use Symfony\Component\HttpFoundation\Response;

trait CreateSuccessViewTrait
{
    protected function createSuccessView(string $message, ?object $responseData = null): Response
    {
        return $this->handleView($this->view(new SuccessResponseDto($message, $responseData)));
    }
}

<?php

namespace App\Module\Core\Application\Api\Controller\Trait;

use App\Module\Core\Domain\Dto\Api\Response\ErrorResponseDto;
use Symfony\Component\HttpFoundation\Response;

trait CreateErrorViewTrait
{
    protected function createErrorView(string $error = self::COMMON_EXCEPTION_MESSAGE): Response
    {
        return $this->handleView($this->view(new ErrorResponseDto($error)));
    }
}

<?php

namespace App\Module\LanguageChoice\Application\Controller;

use App\Module\Core\Application\Api\Controller\AbstractAppRestController;
use App\Module\LanguageChoice\Domain\Dto\LanguageFilterDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class LanguageChoiceController extends AbstractAppRestController
{
    public function startInference(
        #[MapRequestPayload] LanguageFilterDto $filter,
    ): Response {
        // TODO

        return $this->handleView($this->view([]));
    }
}

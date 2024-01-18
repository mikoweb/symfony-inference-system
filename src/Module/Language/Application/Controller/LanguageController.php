<?php

namespace App\Module\Language\Application\Controller;

use App\Module\Core\Application\Api\Controller\AbstractAppRestController;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\Query\GetLanguagesQueryInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class LanguageController extends AbstractAppRestController
{
    #[OA\Tag(name: 'Language')]
    #[OA\Response(
        response: 200,
        description: 'Get languages.',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                ref: new Model(type: LanguageData::class)
            )
        )
    )]
    public function getLanguages(GetLanguagesQueryInterface $getLanguagesQuery): Response
    {
        return $this->handleView($this->view($getLanguagesQuery->getLanguages()->toArray()));
    }
}

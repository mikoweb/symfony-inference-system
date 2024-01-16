<?php

namespace App\Module\LanguageChoice\Application\Controller;

use App\Module\Core\Application\Api\Controller\AbstractAppRestController;
use App\Module\LanguageChoice\Application\Logic\DataFactory\LanguageInferenceResultToDtoFactory;
use App\Module\LanguageChoice\Domain\Dto\LanguageFilterDto;
use App\Module\LanguageChoice\Domain\Dto\LanguageInferenceResultDto;
use App\Module\LanguageChoice\Domain\LanguageInferenceEngineInterface;
use App\Module\LanguageChoice\Domain\LanguageInferenceResult;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class LanguageChoiceController extends AbstractAppRestController
{
    #[OA\Tag(name: 'LanguageChoice')]
    #[OA\Post(requestBody: new OA\RequestBody(attachables: [new Model(type: LanguageFilterDto::class)]))]
    #[OA\Response(
        response: 200,
        description: 'Inference results.',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                ref: new Model(type: LanguageInferenceResultDto::class)
            )
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation Failed!',
    )]
    public function startInference(
        #[MapRequestPayload] LanguageFilterDto $filter,
        LanguageInferenceEngineInterface $languageInferenceEngine,
        LanguageInferenceResultToDtoFactory $resultToDtoFactory
    ): Response {
        $results = $languageInferenceEngine->createResults($filter->toLanguageFilter());

        return $this->handleView($this->view(array_map(
            fn (LanguageInferenceResult $result) => $resultToDtoFactory->createDto($result),
            $results->toArray()
        )));
    }
}

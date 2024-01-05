<?php

namespace App\Module\LanguageChoice\Application\Logic;

use App\Module\LanguageChoice\Application\Logic\Engine\FeaturesFactory;
use App\Module\LanguageChoice\Application\Logic\Engine\ItemsFactory;
use App\Module\LanguageChoice\Application\Logic\Fuzzy\FuzzyResultGenerator;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageInferenceEngineInterface;
use App\Module\LanguageChoice\Domain\LanguageInferenceResult;
use App\Module\LanguageChoice\Domain\LanguageInferenceResultList;

final readonly class LanguageInferenceEngine implements LanguageInferenceEngineInterface
{
    public function __construct(
        private FeaturesFactory $featuresFactory,
        private ItemsFactory $itemsFactory,
    ) {}

    public function createResults(LanguageFilter $filter): LanguageInferenceResultList
    {
        $list = new LanguageInferenceResultList();

        if (!$filter->isSubmitted()) {
            return $list;
        }

        $features = $this->featuresFactory->createFeatures($filter);
        $generator = new FuzzyResultGenerator();
        $items = $this->itemsFactory->createItems($filter, $features);
        $results = $generator->generate($features, $items);

        foreach ($results as $result) {
            $list->add(new LanguageInferenceResult($result->item_identifier, $result->score));
        }

        return $list;
    }
}

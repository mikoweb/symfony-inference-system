<?php

namespace App\Module\Language\Infrastructure\Reader;

use App\Module\Core\Application\Path\AppPathResolver;
use App\Module\Core\Domain\Dataset\DatasetCacheInterface;
use App\Module\Core\Infrastructure\Dataset\Reader\AbstractCsvDatasetReader;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageIdFactoryInterface;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageFactoryInterface;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;

final class ProgrammingLanguagesDatasetReader extends AbstractCsvDatasetReader
{
    private const array HARD_CODED_FEATURE = [
        'php' => ['Reflective' => true],
        'assembly_language' => [
            'Object-oriented' => false,
            'Functional' => false,
            'Procedural' => true,
            'Reflective' => false,
            'Event-driven' => false,
        ],
    ];

    public function __construct(
        private readonly LanguageIdFactoryInterface $languageIdFactory,
        private readonly LanguageUsageFactoryInterface $languageUsageFactory,
        AppPathResolver $pathResolver,
        DatasetCacheInterface $datasetCache
    ) {
        parent::__construct($pathResolver, $datasetCache);
    }

    /**
     * @return ProgrammingLanguagesDataset|LanguageData[]
     */
    public function loadDataset(): ProgrammingLanguagesDataset
    {
        $path = $this->createDatasetPath();

        return $this->datasetCache->get($path, function () {
            $reader = $this->createReader();
            $dataset = new ProgrammingLanguagesDataset();

            foreach ($reader->getRecords() as $row) {
                $dataset->add($this->createLanguageData($row));
            }

            return $dataset;
        });
    }

    protected function getDatasetFolderName(): string
    {
        return 'programming_languages';
    }

    protected function getDatasetFileName(): string
    {
        return 'raw_compare_languages.csv';
    }

    private function createLanguageData(array $row): LanguageData
    {
        $id = $this->languageIdFactory->createId($row['Intended use']);
        /** @var LanguageUsageList $usage */
        $usage = $this->languageUsageFactory
            ->createList($this->getUsage($row['Imperative']))
            ->merge($this->getHardCodedUsage($id));

        return new LanguageData(
            id: $id,
            name: $row['Intended use'],
            usage: $usage,
            objectOriented: $this->getFeature($id, 'Object-oriented', $row),
            functional: $this->getFeature($id, 'Functional', $row),
            procedural: $this->getFeature($id, 'Procedural', $row),
            reflective: $this->getFeature($id, 'Reflective', $row),
            eventDriven: $this->getFeature($id, 'Event-driven', $row),
        );
    }

    private function getFeature(string $langId, string $featureName, array $row): bool
    {
        return self::HARD_CODED_FEATURE[$langId][$featureName] ?? $this->isFeature($row[$featureName]);
    }

    private function isFeature(string $value): bool
    {
        return str_contains($value, 'Yes');
    }

    /**
     * @return string[]
     */
    private function getUsage(string $usage): array
    {
        return array_map(fn (string $value) => trim($value), explode(',', strtolower($usage)));
    }

    private function getHardCodedUsage(string $langId): LanguageUsageList
    {
        $list = match ($langId) {
            'swift', 'objective_c' => [LanguageUsageEnum::MOBILE],
            'c' => [LanguageUsageEnum::EMBEDDED],
            'c_plus_plus' => [
                LanguageUsageEnum::GENERAL,
                LanguageUsageEnum::EMBEDDED,
                LanguageUsageEnum::MOBILE,
                LanguageUsageEnum::DESKTOP,
                LanguageUsageEnum::WEB,
            ],
            'c_sharp' => [
                LanguageUsageEnum::DESKTOP,
                LanguageUsageEnum::MOBILE,
            ],
            'python', 'java', 'visual_basic', 'visual_basic_net' => [
                LanguageUsageEnum::DESKTOP,
            ],
            'assembly_language' => [
                LanguageUsageEnum::GENERAL,
                LanguageUsageEnum::EMBEDDED,
            ],
            'object_pascal' => [
                LanguageUsageEnum::GENERAL,
                LanguageUsageEnum::MOBILE,
                LanguageUsageEnum::DESKTOP,
                LanguageUsageEnum::WEB,
            ],
            default => []
        };

        return new LanguageUsageList($list);
    }
}

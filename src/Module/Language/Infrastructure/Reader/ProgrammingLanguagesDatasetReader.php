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
use Psr\Cache\InvalidArgumentException;

final class ProgrammingLanguagesDatasetReader extends AbstractCsvDatasetReader
{
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
     *
     * @throws InvalidArgumentException
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
            objectOriented: $this->isFeature($row['Object-oriented']),
            functional: $this->isFeature($row['Functional']),
            procedural: $this->isFeature($row['Procedural']),
            reflective: $this->isFeature($row['Reflective']),
            eventDriven: $this->isFeature($row['Event-driven']),
        );
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
            default => []
        };

        return new LanguageUsageList($list);
    }
}

<?php

namespace App\Module\Language\Infrastructure\Reader;

use App\Module\Core\Application\Path\AppPathResolver;
use App\Module\Core\Infrastructure\Dataset\Reader\AbstractCsvDatasetReader;
use App\Module\Language\Application\Logic\ProgrammingLanguage\LanguageIdFactory;
use App\Module\Language\Application\Logic\ProgrammingLanguage\LanguageUsageFactory;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;
use League\Csv\Exception;
use League\Csv\UnavailableStream;

final class ProgrammingLanguagesDatasetReader extends AbstractCsvDatasetReader
{
    public function __construct(
        private readonly LanguageIdFactory $languageIdFactory,
        private readonly LanguageUsageFactory $languageUsageFactory,
        AppPathResolver $pathResolver
    ) {
        parent::__construct($pathResolver);
    }

    /**
     * @throws Exception
     * @throws UnavailableStream
     *
     * @return ProgrammingLanguagesDataset|LanguageData[]
     */
    public function loadDataset(): ProgrammingLanguagesDataset
    {
        $reader = $this->createReader();
        $dataset = new ProgrammingLanguagesDataset();

        foreach ($reader->getRecords() as $row) {
            $dataset->add($this->createLanguageData($row));
        }

        return $dataset;
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
        return new LanguageData(
            id: $this->languageIdFactory->createId($row['Intended use']),
            name: $row['Intended use'],
            usage: $this->languageUsageFactory->createList($this->getUsage($row['Imperative'])),
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
     * @param string $usage
     * @return string[]
     */
    private function getUsage(string $usage): array
    {
        return array_map(fn(string $value) => trim($value), explode(',', strtolower($usage)));
    }
}

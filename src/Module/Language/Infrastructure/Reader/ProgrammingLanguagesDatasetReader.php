<?php

namespace App\Module\Language\Infrastructure\Reader;

use App\Module\Core\Application\Path\AppPathResolver;
use App\Module\Core\Infrastructure\Dataset\Reader\AbstractCsvDatasetReader;
use App\Module\Language\Application\Logic\ProgrammingLanguage\LanguageIdFactory;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageData;
use App\Module\Language\Domain\ProgrammingLanguage\ProgrammingLanguagesDataset;
use League\Csv\Exception;
use League\Csv\UnavailableStream;

final class ProgrammingLanguagesDatasetReader extends AbstractCsvDatasetReader
{
    public function __construct(
        private readonly LanguageIdFactory $languageIdFactory,
        AppPathResolver $pathResolver
    ) {
        parent::__construct($pathResolver);
    }

    /**
     * @throws Exception
     * @throws UnavailableStream
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

    protected function createLanguageData(array $row): LanguageData
    {
        return new LanguageData(
            id: $this->languageIdFactory->createId($row['Intended use']),
            name: $row['Intended use']
        );
    }

    protected function getDatasetFolderName(): string
    {
        return 'programming_languages';
    }

    protected function getDatasetFileName(): string
    {
        return 'raw_compare_languages.csv';
    }
}

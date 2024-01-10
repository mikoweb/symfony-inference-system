<?php

namespace App\Module\Language\Infrastructure\Reader;

use App\Module\Core\Application\Path\AppPathResolver;
use App\Module\Core\Infrastructure\Dataset\DatasetCache;
use App\Module\Core\Infrastructure\Dataset\Reader\AbstractCsvDatasetReader;
use App\Module\Language\Application\Logic\ProgrammingLanguage\LanguageIdFactory;
use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\MostPopular\MostPopularList;
use App\Module\Language\Domain\MostPopular\MostPopularValue;
use DateTime;
use Psr\Cache\InvalidArgumentException;
use RichJenks\Stats\Stats;

final class MostPopularDatasetReader extends AbstractCsvDatasetReader
{
    private const array MAP = [
        'C/C++' => ['c', 'c_plus_plus'],
        'Delphi/Pascal' => ['object_pascal', 'pascal'],
    ];

    public function __construct(
        private readonly LanguageIdFactory $languageIdFactory,
        AppPathResolver $pathResolver,
        DatasetCache $datasetCache
    ) {
        parent::__construct($pathResolver, $datasetCache);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function loadDataset(): MostPopularHashMap
    {
        $path = $this->createDatasetPath();

        return $this->datasetCache->get($path, function () {
            $reader = $this->createReader();
            $dataset = new MostPopularHashMap();
            $rows = array_values(iterator_to_array($reader->getRecords()));
            $dates = $this->getDates($rows);
            $years = $this->getYears($dates);

            if (count($rows) > 0) {
                $langKeys = $this->getLangKeys($rows[0]);
                $langIdMap = $this->getLangIdMap($langKeys);

                foreach ($langIdMap as $key => $langIds) {
                    $this->putLanguage($dataset, $rows, $dates, $years, $key, $langIds);
                }
            }

            return $dataset;
        });
    }

    protected function getDatasetFolderName(): string
    {
        return 'most_popular_programming_languages';
    }

    protected function getDatasetFileName(): string
    {
        return 'most_popular_programming_languages.csv';
    }

    private function putLanguage(
        MostPopularHashMap $dataset,
        array $rows,
        array $dates,
        array $years,
        string $langKey,
        array $langIds
    ): void {
        $list = new MostPopularList();

        foreach ($years as $year) {
            $yearValues = [];

            foreach ($dates as $k => $date) {
                $dateYear = (int) $date->format('Y');

                if ($dateYear < $year) {
                    continue;
                }

                if ($dateYear > $year) {
                    break;
                }

                $yearValues[] = (float) $rows[$k][$langKey];
            }

            $list->add(new MostPopularValue(
                langKey: $langKey,
                year: $year,
                percentageValue: Stats::mean($yearValues),
            ));
        }

        foreach ($langIds as $id) {
            $dataset->put($id, $list);
        }
    }

    /**
     * @return string[]
     */
    private function getLangKeys(array $row): array
    {
        return array_keys(array_slice($row, 1));
    }

    private function getLangIdMap(array $langKeys): array
    {
        $map = [];
        foreach ($langKeys as $key) {
            $map[$key] = self::MAP[$key] ?? [$this->languageIdFactory->createId($key)];
        }

        return $map;
    }

    /**
     * @return DateTime[]
     */
    private function getDates(array $rows): array
    {
        return array_map(fn (array $row) => DateTime::createFromFormat('F Y', $row['Date']), $rows);
    }

    /**
     * @param DateTime[] $dateColumn
     *
     * @return int[]
     */
    private function getYears(array $dateColumn): array
    {
        $years = [];
        foreach ($dateColumn as $date) {
            $year = (int) $date->format('Y');

            if (!in_array($year, $years)) {
                $years[] = $year;
            }
        }

        return $years;
    }
}

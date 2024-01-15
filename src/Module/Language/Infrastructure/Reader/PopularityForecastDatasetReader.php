<?php

namespace App\Module\Language\Infrastructure\Reader;

use App\Module\Core\Infrastructure\Dataset\Reader\AbstractDatasetReader;
use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\MostPopular\MostPopularList;
use App\Module\Language\Domain\MostPopular\MostPopularValue;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

final class PopularityForecastDatasetReader extends AbstractDatasetReader
{
    public function loadDataset(): MostPopularHashMap
    {
        $path = $this->createDatasetPath();

        return $this->datasetCache->get($path, function () use ($path) {
            if (!file_exists($path)) {
                throw new FileNotFoundException("Not found $path!");
            }

            $data = json_decode(file_get_contents($path), true);
            $map = new MostPopularHashMap();

            foreach ($data as $langId => $years) {
                $map->put($langId, $this->createLangList($langId, $years));
            }

            return $map;
        });
    }

    protected function getDatasetFolderName(): string
    {
        return 'popularity_forecast';
    }

    protected function getDatasetFileName(): string
    {
        return 'forecast.json';
    }

    private function createLangList(string $langId, array $years): MostPopularList
    {
        $list = new MostPopularList();

        foreach ($years as $year => $value) {
            $list->add(new MostPopularValue(
                langKey: $langId,
                year: (int) $year,
                percentageValue: $value
            ));
        }

        return $list;
    }
}

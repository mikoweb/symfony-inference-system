<?php

namespace App\Module\Language\Infrastructure\Reader;

use App\Module\Core\Infrastructure\Dataset\Reader\AbstractDatasetReader;
use App\Module\Language\Domain\SpeedComparison\SpeedComparisonData;
use App\Module\Language\Domain\SpeedComparison\SpeedComparisonList;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

final class SpeedComparisonDatasetReader extends AbstractDatasetReader
{
    public function loadDataset(): SpeedComparisonList
    {
        $path = $this->createDatasetPath();

        if (!file_exists($path)) {
            throw new FileNotFoundException("Not found $path!");
        }

        $rows = json_decode(file_get_contents($path), true);
        $list = new SpeedComparisonList();

        foreach ($rows as $row) {
            $list->add($this->createData($row));
        }

        return $list;
    }

    protected function getDatasetFolderName(): string
    {
        return 'languages_speed_comparison';
    }

    protected function getDatasetFileName(): string
    {
        return 'languages_speed_comparison.json';
    }

    private function createData(array $row): SpeedComparisonData
    {
        return new SpeedComparisonData(
            langName: $row['langName'],
            median: $row['median'],
        );
    }
}

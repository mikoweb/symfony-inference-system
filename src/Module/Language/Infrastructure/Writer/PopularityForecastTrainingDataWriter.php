<?php

namespace App\Module\Language\Infrastructure\Writer;

use App\Module\Core\Application\Path\AppPathResolver;
use App\Module\Language\Domain\MostPopular\MostPopularHashMap;
use App\Module\Language\Domain\MostPopular\MostPopularValue;

final readonly class PopularityForecastTrainingDataWriter
{
    public function __construct(
        private AppPathResolver $pathResolver
    ) {}

    public function writeTrainingData(MostPopularHashMap $mostPopular): string
    {
        $map = $mostPopular->toArray();
        $data = [];

        foreach ($map as $key => $list) {
            $data[$key] = array_map(
                fn (MostPopularValue $value) => [[$value->year], $value->percentageValue],
                $list->toArray(),
            );
        }

        $path = $this->getFilePath();
        file_put_contents($this->getFilePath(), json_encode($data));

        return $path;
    }

    private function getFilePath(): string
    {
        return $this->pathResolver->getDatasetPath('popularity_forecast/training_data.json');
    }
}

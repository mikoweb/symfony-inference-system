<?php

namespace App\Module\Language\Infrastructure\Query;

use App\Module\Language\Application\Logic\ProgrammingLanguage\LanguageIdFactory;
use App\Module\Language\Domain\Query\GetSpeedComparisonQueryInterface;
use App\Module\Language\Domain\SpeedComparison\SpeedComparisonData;
use App\Module\Language\Domain\SpeedComparison\SpeedComparisonHashMap;
use App\Module\Language\Domain\SpeedComparison\SpeedComparisonList;
use App\Module\Language\Infrastructure\Reader\SpeedComparisonDatasetReader;
use Psr\Cache\InvalidArgumentException;

final class GetSpeedComparisonQuery implements GetSpeedComparisonQueryInterface
{
    private const array IGNORE = [
        'python_pypy',
    ];

    private static ?SpeedComparisonHashMap $speedComparison = null;

    public function __construct(
        private readonly GetLanguagesIdsQuery $getLanguagesIdsQuery,
        private readonly SpeedComparisonDatasetReader $speedComparisonDatasetReader,
        private readonly LanguageIdFactory $languageIdFactory
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function getSpeedComparison(): SpeedComparisonHashMap
    {
        if (is_null(self::$speedComparison)) {
            $langIds = $this->getLanguagesIdsQuery->getIds();
            $speedComparison = $this->speedComparisonDatasetReader->loadDataset();
            $speedComparisonIds = $this->createSpeedComparisonIds($speedComparison);
            self::$speedComparison = new SpeedComparisonHashMap();

            foreach ($langIds as $langId) {
                $this->putToMap(self::$speedComparison, $speedComparison, $speedComparisonIds, $langId);
            }
        }

        return self::$speedComparison;
    }

    private function putToMap(
        SpeedComparisonHashMap $map,
        SpeedComparisonList $speedComparison,
        array $speedComparisonIds,
        string $langId
    ): void {
        foreach ($speedComparisonIds as $k => $speedComparisonId) {
            if (in_array($speedComparisonId, self::IGNORE)) {
                continue;
            }

            if ($speedComparisonId === $langId || str_starts_with($speedComparisonId, "{$langId}_")) {
                $map->put($langId, $speedComparison[$k]);
                break;
            }
        }
    }

    /**
     * @return string[]
     */
    private function createSpeedComparisonIds(SpeedComparisonList $speedComparison): array
    {
        return array_map(
            fn (SpeedComparisonData $data) => $this->languageIdFactory->createId($data->langName),
            $speedComparison->toArray()
        );
    }
}

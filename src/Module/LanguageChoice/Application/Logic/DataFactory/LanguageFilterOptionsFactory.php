<?php

namespace App\Module\LanguageChoice\Application\Logic\DataFactory;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\LanguageChoice\Domain\Dto\LanguageFilterOptionsDto;
use App\Module\LanguageChoice\Domain\Dto\PackageDto;
use App\Module\LanguageChoice\Domain\Dto\SelectOptionDto;
use App\Module\LanguageChoice\Domain\Filter\FilterPackageHashMap;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\UserExperienceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageFilterModeEnum;
use Symfony\Contracts\Translation\TranslatorInterface;
use UnitEnum;

use function Symfony\Component\String\u;

final readonly class LanguageFilterOptionsFactory
{
    public function __construct(
        private TranslatorInterface $translator
    ) {}

    public function createOptions(): LanguageFilterOptionsDto
    {
        return new LanguageFilterOptionsDto(
            usageOptions: $this->createValues(LanguageUsageEnum::cases()),
            usageModeOptions: $this->createValues(LanguageFilterModeEnum::cases()),
            featuresOptions: $this->createValues(LanguageFeatureEnum::cases()),
            featuresModeOptions: $this->createValues(LanguageFilterModeEnum::cases()),
            minimumPerformanceLevelOptions: $this->createValues(PerformanceLevelEnum::cases()),
            minimumPopularityLevelOptions: $this->createValues(PopularityLevelEnum::cases()),
            userExperienceLevelOptions: $this->createValues(UserExperienceLevelEnum::cases()),
            filterPackages: $this->createPackages(),
        );
    }

    /**
     * @param UnitEnum[] $cases
     *
     * @return SelectOptionDto[]
     */
    private function createValues(array $cases): array
    {
        return array_map(
            fn (UnitEnum $enum) => new SelectOptionDto($enum->value, $this->transformLabel($enum->name)),
            $cases
        );
    }

    private function transformLabel(string $label): string
    {
        $key = u($label)->lower()->snake()->toString();

        return $this->translator->trans("language_filter_option.$key");
    }

    /**
     * @return PackageDto[]
     */
    private function createPackages(): array
    {
        $packages = [];

        foreach (FilterPackageHashMap::getCommonMap() as $key => $filter) {
            /* @var LanguageFilter $filter */
            $packages[] = new PackageDto($key, $filter->toDto());
        }

        return $packages;
    }
}

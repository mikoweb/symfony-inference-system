<?php

namespace App\Module\LanguageChoice\Domain\Dto;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItem;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItemList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageFilterModeEnum;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final readonly class LanguageFilterDto
{
    private const array NULLABLE_PROPERTIES = [
        'usage',
        'features',
        'minimumPerformanceLevel',
        'minimumPopularityLevel',
        'userExperienceFilterItemList',
    ];

    public function __construct(
        /**
         * @var string[]
         */
        #[Assert\Choice(callback: [LanguageUsageEnum::class, 'getAllowedValues'], multiple: true)]
        public ?array $usage = null,

        #[Assert\NotBlank]
        #[Assert\Choice(callback: [LanguageFilterModeEnum::class, 'getAllowedValues'])]
        public string $usageMode = LanguageFilterModeEnum::AND->value,

        /**
         * @var string[]
         */
        #[Assert\Choice(callback: [LanguageFeatureEnum::class, 'getAllowedValues'], multiple: true)]
        public ?array $features = null,

        #[Assert\NotBlank]
        #[Assert\Choice(callback: [LanguageFilterModeEnum::class, 'getAllowedValues'])]
        public string $featuresMode = LanguageFilterModeEnum::AND->value,

        #[Assert\Choice(callback: [PerformanceLevelEnum::class, 'getAllowedValues'])]
        public ?int $minimumPerformanceLevel = null,

        #[Assert\Choice(callback: [PopularityLevelEnum::class, 'getAllowedValues'])]
        public ?int $minimumPopularityLevel = null,

        /**
         * @var UserExperienceFilterItem[]|null
         */
        #[Assert\Valid]
        #[Assert\All([
            new Assert\Type(UserExperienceFilterItem::class),
        ])]
        public ?array $userExperienceFilterItemList = null,
    ) {}

    public function toLanguageFilter(): LanguageFilter
    {
        return new LanguageFilter(
            usage: !is_null($this->usage)
                ? new LanguageUsageList(array_map(fn (string $value) => LanguageUsageEnum::from($value), $this->usage))
                : null,
            usageMode: LanguageFilterModeEnum::from($this->usageMode),
            features: !is_null($this->features)
                ? new LanguageFeatureList(
                    array_map(fn (string $value) => LanguageFeatureEnum::from($value), $this->features)
                ) : null,
            featuresMode: LanguageFilterModeEnum::from($this->featuresMode),
            minimumPerformanceLevel: PerformanceLevelEnum::tryFrom($this->minimumPerformanceLevel),
            minimumPopularityLevel: PopularityLevelEnum::tryFrom($this->minimumPopularityLevel),
            userExperienceFilterItemList: !is_null($this->userExperienceFilterItemList)
                ? new UserExperienceFilterItemList($this->userExperienceFilterItemList)
                : null,
        );
    }

    #[Ignore]
    public function isSubmitted(): bool
    {
        foreach (self::NULLABLE_PROPERTIES as $property) {
            if (!is_null($this->{$property})) {
                return true;
            }
        }

        return false;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context): void
    {
        if (!$this->isSubmitted()) {
            $context->addViolation('You have not completed any fields!');
        }
    }
}

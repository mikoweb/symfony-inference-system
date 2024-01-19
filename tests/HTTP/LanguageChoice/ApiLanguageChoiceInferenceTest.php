<?php

namespace App\Tests\HTTP\LanguageChoice;

use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageFeatureList;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageEnum;
use App\Module\Language\Domain\ProgrammingLanguage\LanguageUsageList;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItem;
use App\Module\LanguageChoice\Domain\Filter\UserExperienceFilterItemList;
use App\Module\LanguageChoice\Domain\Fuzzy\PerformanceLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\PopularityLevelEnum;
use App\Module\LanguageChoice\Domain\Fuzzy\UserExperienceLevelEnum;
use App\Module\LanguageChoice\Domain\LanguageFilter;
use App\Module\LanguageChoice\Domain\LanguageFilterModeEnum;
use App\Tests\AbstractApiTestCase;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiLanguageChoiceInferenceTest extends AbstractApiTestCase
{
    public function testInference(): void
    {
        $filter = new LanguageFilter(
            usage: new LanguageUsageList([LanguageUsageEnum::WEB]),
            usageMode: LanguageFilterModeEnum::AND,
            features: new LanguageFeatureList([LanguageFeatureEnum::OBJECT_ORIENTED]),
            featuresMode: LanguageFilterModeEnum::AND,
            minimumPerformanceLevel: PerformanceLevelEnum::LOW,
            minimumPopularityLevel: PopularityLevelEnum::MEDIUM,
            userExperienceFilterItemList: new UserExperienceFilterItemList([
                new UserExperienceFilterItem('php', UserExperienceLevelEnum::VERY_HIGH->name),
                new UserExperienceFilterItem('javascript', UserExperienceLevelEnum::HIGH->name),
                new UserExperienceFilterItem('java', UserExperienceLevelEnum::MEDIUM->name),
                new UserExperienceFilterItem('python', UserExperienceLevelEnum::VERY_LOW->name),
                new UserExperienceFilterItem('ruby', UserExperienceLevelEnum::VERY_LOW->name),
            ]),
        );

        $results = $this->apiRequest(
            'POST',
            $this->getRouter()->generate('api_language_choice_inference'),
            $this->getFilterData($filter),
        );

        $this->assertResponseIsSuccessful();

        $this->assertIsArray($results);
        $this->assertCount(30, $results);
        $this->assertEquals(16, count(array_filter($results, fn (array $item) => $item['score'] > 0.0)));

        $this->assertResultsOrder([
            'javascript',
            'java',
            'php',
            'c_sharp',
            'c_plus_plus',
            'python',
            'rust',
            'go',
            'scala',
            'nim',
            'ruby',
            'kotlin',
            'dart',
            'groovy',
            'perl',
            'object_pascal',
        ], $results);
    }

    private function assertResultsOrder(array $langsOrder, array $results): void
    {
        foreach ($langsOrder as $key => $langId) {
            $this->assertEquals($langId, $results[$key]['langId']);
        }
    }

    private function getFilterData(LanguageFilter $filter): array
    {
        $context = (new ObjectNormalizerContextBuilder())->withSkipNullValues(true)->toArray();

        return json_decode($this->getSerializer()->serialize($filter->toDto(), 'json', $context), true);
    }

    private function getSerializer(): SerializerInterface
    {
        return $this->getService(SerializerInterface::class);
    }
}

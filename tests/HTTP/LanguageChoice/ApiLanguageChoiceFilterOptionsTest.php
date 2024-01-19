<?php

namespace App\Tests\HTTP\LanguageChoice;

use App\Tests\AbstractApiTestCase;

final class ApiLanguageChoiceFilterOptionsTest extends AbstractApiTestCase
{
    public function testOptions(): void
    {
        $options = $this->apiRequest('GET', $this->getRouter()->generate('api_language_choice_filter_options'));
        $this->assertResponseIsSuccessful();

        $this->assertIsArray($options);
        $this->assertOptionsProperty($options, 'usageOptions');
        $this->assertOptionsProperty($options, 'usageModeOptions');
        $this->assertOptionsProperty($options, 'featuresOptions');
        $this->assertOptionsProperty($options, 'featuresModeOptions');
        $this->assertOptionsProperty($options, 'minimumPerformanceLevelOptions');
        $this->assertOptionsProperty($options, 'minimumPopularityLevelOptions');
        $this->assertOptionsProperty($options, 'userExperienceLevelOptions');
        $this->assertOptionsProperty($options, 'filterPackages');
        $this->assertOptionsProperty($options, 'popularityForecastYears');
    }

    private function assertOptionsProperty(array $options, string $propertyName): void
    {
        $this->assertArrayHasKey($propertyName, $options);
        $this->assertNotEmpty($options[$propertyName]);
    }
}

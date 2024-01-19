<?php

namespace App\Tests\HTTP\Language;

use App\Module\Language\Domain\Query\GetLanguagesQueryInterface;
use App\Tests\AbstractApiTestCase;

final class ApiLanguagesListTest extends AbstractApiTestCase
{
    public function testList(): void
    {
        $list = $this->apiRequest('GET', $this->getRouter()->generate('api_language_index'));
        $this->assertResponseIsSuccessful();

        $this->assertIsArray($list);
        $listFromQuery = $this->getListQuery()->getLanguages();
        $this->assertEquals($listFromQuery->count(), count($list));
    }

    private function getListQuery(): GetLanguagesQueryInterface
    {
        return $this->getService(GetLanguagesQueryInterface::class);
    }
}

<?php

namespace App\Tests;

use App\Tests\Helper\Traits\ServiceableTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\RouterInterface;

abstract class AbstractApiTestCase extends WebTestCase
{
    use ServiceableTrait;

    protected KernelBrowser $client;

    protected function getRouter(): RouterInterface
    {
        return $this->getService(RouterInterface::class);
    }

    protected function getBrowser(): KernelBrowser
    {
        return $this->client;
    }

    protected function apiRequest(string $method, string $url, array $data = [], array $files = []): array
    {
        $this->getBrowser()->request($method, $url, $data, $files, [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_Accept' => 'application/json',
        ], json_encode($data));

        $decodedResponse = json_decode($this->getBrowser()->getResponse()->getContent(), true) ?? [];

        return is_string($decodedResponse) ? [$decodedResponse] : $decodedResponse;
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }
}

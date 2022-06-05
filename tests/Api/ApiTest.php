<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ApiTest extends ApiTestCase
{
    public function apiToken(): string
    {
        $user = static::getContainer()->get(UserRepository::class)->findOneBy(['username' => 'rina']);
        return $user->getApiToken();
    }
    public function testComments(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/comments');
        $this->assertResponseStatusCodeSame(401);

        $response = $client->withOptions([
            'headers' => ['x-auth-token' => $this->apiToken(), 'content-type' => 'application/json; charset=utf-8'],
        ])->request('GET', '/api/comments');
        $this->assertResponseStatusCodeSame(200);

        $this->assertJson($response->getContent());
        $resultArray = $response->toArray();
        $this->assertIsArray($resultArray);
    }
    public function testNews(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/news');
        $this->assertResponseStatusCodeSame(401);

        $response = $client->withOptions([
            'headers' => ['x-auth-token' => $this->apiToken(), 'content-type' => 'application/json; charset=utf-8'],
        ])->request('GET', '/api/news');
        $this->assertResponseStatusCodeSame(200);

        $this->assertJson($response->getContent());
        $resultArray = $response->toArray();
        $this->assertIsArray($resultArray);
    }
    public function testUsers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/users');
        $this->assertResponseStatusCodeSame(401);

        $response = $client->withOptions([
            'headers' => ['x-auth-token' => $this->apiToken(), 'content-type' => 'application/json; charset=utf-8'],
        ])->request('GET', '/api/users');
        $this->assertResponseStatusCodeSame(200);

        $this->assertJson($response->getContent());
        $resultArray = $response->toArray();
        $this->assertIsArray($resultArray);
    }
}

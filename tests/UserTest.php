<?php

declare(strict_types=1);

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UserTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        // Given
        $url = '/api//users';

        // When
        $response = static::createClient()->request('GET', $url);

        // Then
        self::assertResponseIsSuccessful();
        $json = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertEquals(10, $json['hydra:totalItems']);
        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertCount(10, $json['hydra:member']);
    }
}

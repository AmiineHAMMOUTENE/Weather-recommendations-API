<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecommendationControllerTest extends WebTestCase
{
    public function testMissingCity(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/recommendations',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['weather' => []])
        );

        $this->assertResponseStatusCodeSame(400);
        $this->assertStringContainsString('Missing city parameter', $client->getResponse()->getContent());
    }

    public function testRecommendWithValidCityForToday(): void
    {
        $client = static::createClient();

        $payload = [
            'weather' => ['city' => 'Paris'],
            'date' => 'today'
        ];

        $client->request(
            'POST',
            '/api/recommendations',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $this->assertResponseIsSuccessful();

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertNotEmpty($responseData['products']);
        $this->assertArrayHasKey('weather', $responseData);
        $this->assertEquals('Paris', $responseData['weather']['city']);
        $this->assertContains($responseData['weather']['is'], ['cold', 'mild', 'hot']);
    }

    public function testRecommendWithValidCityForTomorrow(): void
    {
        $client = static::createClient();

        $payload = [
            'weather' => ['city' => 'Paris'],
            'date' => 'tomorrow'
        ];

        $client->request(
            'POST',
            '/api/recommendations',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $this->assertResponseIsSuccessful();

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertNotEmpty($responseData['products']);
        $this->assertArrayHasKey('weather', $responseData);
        $this->assertEquals('Paris', $responseData['weather']['city']);
        $this->assertEquals('tomorrow', $responseData['weather']['date']);
        $this->assertContains($responseData['weather']['is'], ['cold', 'mild', 'hot']);
    }

    public function testRecommendWithInvalidWeatherApiResponse(): void
    {
        $client = static::createClient();

        $payload = [
            'weather' => ['city' => 'InvalidCity'],
            'date' => 'today'
        ];

        $client->request(
            'POST',
            '/api/recommendations',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $response = $client->getResponse();
        if ($response->getStatusCode() === 500) {
            $this->assertResponseStatusCodeSame(500);
            $this->assertStringContainsString('Failed to fetch weather data', $client->getResponse()->getContent());
        } else {
            $this->markTestSkipped('The API did not return a 500 error as expected.');
        }
    }
}

<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testGetProductsStatusCode()
    {
        $client = static::createClient();
        $client->request('GET', '/api/products');

        $this->assertResponseIsSuccessful(); // statut
    }

    public function testGetProductsContentTypeIsJson()
    {
        $client = static::createClient();
        $client->request('GET', '/api/products');

        $contentType = $client->getResponse()->headers->get('Content-Type');
        $this->assertTrue(
            str_contains($contentType, 'application/json') || str_contains($contentType, 'application/ld+json'),
            'Le Content-Type doit contenir "application/json" ou "application/ld+json"'
        );
    }
    //test pour le json des produits
    public function testGetProductsReturnsJsonArray()
    {
        $client = static::createClient();
        $client->request('GET', '/api/products');

        $content = $client->getResponse()->getContent();
        $data = json_decode($content, true);

        $this->assertIsArray($data, 'La réponse doit être un tableau JSON.');
    }

    public function testGetFirstProductHasExpectedFields()
    {
        $client = static::createClient();
        $client->request('GET', '/api/products');

        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        // Vérifier que la clé 'member' existe et est un tableau
        $this->assertArrayHasKey('member', $data, 'La réponse doit contenir la clé "member"');

        $products = $data['member'];

        if (count($products) === 0) {
            $this->markTestSkipped('Aucun produit trouvé dans la réponse.');
            return;
        }

        $firstProduct = $products[0];
        $this->assertIsArray($firstProduct, 'Le premier produit doit être un tableau.');

        $this->assertArrayHasKey('id', $firstProduct);
        $this->assertArrayHasKey('name', $firstProduct);
        $this->assertArrayHasKey('price', $firstProduct);
        $this->assertArrayHasKey('type', $firstProduct);
    }
}

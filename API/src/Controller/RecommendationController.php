<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;  // <-- ajout
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecommendationController extends AbstractController
{
    private HttpClientInterface $client;
    private ProductRepository $productRepository;
    private string $apiKey;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $client, ProductRepository $productRepository, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->productRepository = $productRepository;
        $this->logger = $logger;  //pour afficher la temperature dans le dev.log
        $this->apiKey = $_ENV['WEATHERAPI_KEY'] ?? 'your_default_api_key_here';
    }

    #[Route('/api/recommendations', name: 'api_recommendations', methods: ['POST'])]
    public function recommend(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['weather']['city'])) {
            return $this->json(['error' => 'Missing city parameter'], 400);
        }

        $city = $data['weather']['city'];
        $date = $data['date'] ?? 'today';

        $endpoint = 'http://api.weatherapi.com/v1/forecast.json';
        $queryDate = $date === 'tomorrow' ? date('Y-m-d', strtotime('+1 day')) : date('Y-m-d');

        $response = $this->client->request('GET', $endpoint, [
            'query' => [
                'key' => $this->apiKey,
                'q' => $city,
                'dt' => $queryDate,
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            return $this->json(['error' => 'Failed to fetch weather data'], 500);
        }

        $weatherData = $response->toArray();

        $temp_c = null;
        if ($date === 'today') {
            $temp_c = $weatherData['current']['temp_c'] ?? null;
        } else {
            $temp_c = $weatherData['forecast']['forecastday'][0]['day']['avgtemp_c'] ?? null;
        }

        if ($temp_c === null) {
            return $this->json(['error' => 'Temperature data not found'], 500);
        }

        // recuperer et afficher la temparature de la requete
        $this->logger->info('Température récupérée : ' . $temp_c . '°C à ' . $city . ' pour la date ' . $queryDate);

        if ($temp_c < 10) {
            $type = 'pull';
            $weatherStatus = 'cold';
        } elseif ($temp_c <= 20) {
            $type = 'sweat';
            $weatherStatus = 'mild';
        } else {
            $type = 't-shirt';
            $weatherStatus = 'hot';
        }

        $products = $this->productRepository->findBy(['type' => $type]);

        $productsArray = array_map(function ($product) {
            return [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
            ];
        }, $products);

        return $this->json([
            'products' => $productsArray,
            'weather' => [
                'city' => $city,
                'is' => $weatherStatus,
                'date' => $date,
            ],
        ]);
    }
}

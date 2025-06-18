<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $products = $this->productRepository->findAll();

        $productsArray = array_map(function ($product) {
            return [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'type' => $product->getType(),
            ];
        }, $products);

        return $this->json($productsArray);
    }
}

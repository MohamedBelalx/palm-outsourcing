<?php

namespace App\Service;

use App\Repository\Interface\IProductRepository;

class ProductService
{
    private IProductRepository $productRepository;
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->productRepository->getAllProducts();
    }
}

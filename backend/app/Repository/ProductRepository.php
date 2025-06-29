<?php

namespace App\Repository;

use App\Repository\Interface\IProductRepository;
use App\DTO\ProductDTO;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function store(ProductDTO $product)
    {
        Product::create($product->toArray());
    }
}

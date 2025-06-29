<?php

namespace App\Repository\Interface;

use App\DTO\ProductDTO;

interface IProductRepository
{
    public function store(ProductDTO $product);
    public function getAllProducts(): \Illuminate\Database\Eloquent\Collection;
}

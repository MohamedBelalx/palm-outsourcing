<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class ProductDTO extends Data
{
    public function __construct(
        public string $title,
        public string $price,
        public string $image_url
    ) {}
}

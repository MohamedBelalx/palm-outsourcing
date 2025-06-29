<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\DTO\ProductDTO;
use App\Http\Resources\ProductResource;
use App\Service\JumiaScrapingService;
use App\Service\ProductService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{

    protected $userAgents = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64)...',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)...',
        'Mozilla/5.0 (Linux; Android 10)...',
    ];

    private $jumiaScrapingService;
    private $productService;


    public function __construct(JumiaScrapingService $jumiaScrapingService, ProductService $productService)
    {
        $this->jumiaScrapingService = $jumiaScrapingService;
        $this->productService = $productService;
    }
    public function scrapeAndStore(): void
    {
        // for later use to fetch diff urls
        try {
            $this->jumiaScrapingService->fetchProducts("https://www.jumia.com.eg/apple/");
        } catch (\Throwable $e) {
            logger()->error('Scraping failed', ['message' => $e->getMessage()]);
        }
    }

    public function getAllProducts(): AnonymousResourceCollection
    {
        return ProductResource::collection($this->productService->getAllProducts());
    }
}

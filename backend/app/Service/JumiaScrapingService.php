<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use App\DTO\ProductDTO;
use App\Repository\Interface\IProductRepository;

class JumiaScrapingService
{
    private IProductRepository $productRepository;
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function fetchProducts(String $url): array
    {
        // without proxy
        // $html = Http::withHeaders([
        //     'User-Agent' => $this->getRandomUserAgent(),
        // ])->get($url)->body(); // Uses Guzzle under the hood

        // with proxy
        $proxy = Http::get('http://localhost:8081/proxy')->json('proxy');
        $html = Http::withOptions(['proxy' => $proxy])
        ->withHeaders(['User-Agent' => $this->getRandomUserAgent(),])
        ->get($url)
        ->body();
        $crawler = new Crawler($html);
        dd($html);

        $products = [];

        $crawler->filter('article.prd')->each(function (Crawler $node) use (&$products) {
            $name = $node->filter('h3.name')->text(null);
            $price = $node->filter('div.prc')->text(null);
            $img = $node->filter('img')->attr('data-src') ?? $node->filter('img')->attr('src');

            $products[] = new ProductDTO($name, $price, $img);
        });
        dd($products);
        collect($products)->each(fn($product) => $this->storeProduct($product));
        return $products;
    }
    public function storeProduct(ProductDTO $product): void
    {
        $this->productRepository->store($product);
    }
    private function getRandomUserAgent(): string
    {
        $userAgents = [
            // Desktop browsers
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',

            // Mobile browsers
            'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Linux; Android 12; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36',

            // Googlebot
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ];

        return $userAgents[array_rand($userAgents)];
    }
}

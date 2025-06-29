"use client";

import { useEffect, useState } from "react";
import { Product } from "./types/Product";
import { fetchProducts } from "./lib/fetchProducts";
import ProductGrid from "./components/ProductGrid";

export default function ProductsPage() {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  const loadData = async () => {
    try {
      const data = await fetchProducts();
      setProducts(data);
      setError(null);
    } catch (err) {
      console.error("Error fetching products:", err);
      setError("Failed to load products. Try again later.");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    loadData();
    const intervalId = setInterval(loadData, 30000);
    return () => clearInterval(intervalId);
  }, []);

  return (
    <div className="min-h-screen bg-gray-50 py-10">
      <div className="container mx-auto px-4">
        <h1 className="text-3xl font-bold mb-8 text-center text-gray-800">
          Jumia Scraped Products
        </h1>

        {error && (
          <p className="text-center text-red-500 bg-red-100 py-2 px-4 rounded mb-6 max-w-xl mx-auto">
            {error}
          </p>
        )}

        <ProductGrid products={products} loading={loading} />
      </div>
    </div>
  );
}

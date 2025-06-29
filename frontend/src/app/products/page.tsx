"use client";

import { useEffect, useState } from "react";
import ProductGrid from "./components/ProductGrid";
import { Product } from "./types/Product";

export default function ProductsPage() {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  const API_URL = process.env.NEXT_PUBLIC_API_URL ?? "http://localhost:8000";

  const fetchProducts = async () => {
    try {
      const res = await fetch(`${API_URL}/api/products`);
      const data = await res.json();
      setProducts(data.data ?? []);
      setError(null);
    } catch (err) {
      console.error("Fetch error:", err);
      setError("Failed to load products.");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchProducts();
    const interval = setInterval(fetchProducts, 30000);
    return () => clearInterval(interval);
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

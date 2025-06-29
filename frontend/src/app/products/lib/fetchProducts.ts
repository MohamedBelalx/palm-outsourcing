import { Product } from "../types/Product";
const API_URL = process.env.NEXT_PUBLIC_API_URL;
export async function fetchProducts(): Promise<Product[]> {
  const res = await fetch(`${API_URL}/api/products`);
  const data = await res.json();
  return data.data ?? [];
}

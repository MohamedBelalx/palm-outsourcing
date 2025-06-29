"use client";

import Image from "next/image";
import { Product } from "../types/Product";

export default function ProductCard({ title, price, image_url }: Product) {
  return (
    <div className="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 group">
      <div className="relative w-full h-56 bg-gray-100">
        <Image
          src={image_url}
          alt={title}
          fill
          className="object-contain p-4 transition-transform duration-300 group-hover:scale-105"
          sizes="(max-width: 768px) 100vw, 33vw"
        />
      </div>
      <div className="p-4">
        <h2 className="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
          {title}
        </h2>
        <p className="text-green-600 font-medium text-md">{price}</p>
      </div>
    </div>
  );
}

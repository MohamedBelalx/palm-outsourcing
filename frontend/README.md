# 🎨 Jumia Scraper Frontend

This is the frontend interface for the Jumia Product Scraper, built with **Next.js 15 (App Router)**, **TypeScript**, and **Tailwind CSS**.

It fetches products from the Laravel backend and displays them in a responsive, modern UI with skeleton loading, auto-refresh, and proxy-safe rendering.

---

## 📁 Folder Structure
```
./
├── app/                          # Next.js 15 App Router structure
│   ├── layout.tsx               # Root layout with HTML scaffold
│   ├── globals.css              # Global Tailwind styles
│   └── products/                # Route: /products
│       ├── page.tsx            # Entry point for product listing
│       ├── types/              # TypeScript interfaces (e.g. Product.ts)
│       ├── lib/                # API utilities (e.g. fetchProducts.ts)
│       ├── components/         # UI components:
│       │   ├── ProductCard.tsx
│       │   ├── ProductGrid.tsx
│       │   └── ProductSkeleton.tsx
│       └── loading.tsx         # Suspense fallback skeleton grid
├── public/                      # Static assets (optional screenshot)
├── .env.local                   # Local environment variables
├── next.config.js               # Next.js configuration (e.g. remotePatterns)
├── tsconfig.json                # TypeScript configuration
├── tailwind.config.ts           # Tailwind customizations
└── package.json                 # Project dependencies and scripts
```
---

## 🚀 Setup Instructions

```bash
cd frontend
npm install
cp .env.example .env.local
# Set: NEXT_PUBLIC_API_URL=http://localhost:8000
npm run dev
Visit: http://localhost:3000
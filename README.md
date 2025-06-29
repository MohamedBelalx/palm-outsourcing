# 🛍️ Full Stack Jumia Product Scraper

This is a full-stack web scraping system designed to extract, store, and display products from [Jumia Egypt](https://www.jumia.com.eg/). It features:

- ✅ A **Laravel 10** backend that scrapes product data and exposes a REST API
- ✅ A **Next.js 15 (App Router + TypeScript)** frontend to view data professionally
- ✅ A **Golang microservice** that rotates proxy IPs dynamically for scraping
- ✅ Modular, scalable architecture with a clean UI and automatic updates

---

## 📂 Folder Structure
```
./
├── backend(laravel)/    # Laravel backend service
├── frontend(nextjs)/    # Next.js frontend (App Router + TypeScript)
├── proxy-golang/        # Golang proxy rotator microservice
└── README.md            # Project overview and setup instructions

```
---

## ⚙️ Requirements

- PHP ^8.2
- Node.js ^18+
- Go 1.20.7
- MySQL
- Composer + npm

---

## 🚀 Setup Instructions

### 1. 🔧 Laravel Backend (`backend/`)

```bash
cd backend-laravel
composer install
cp .env.example .env
php artisan key:generate
# Edit .env to match your DB credentials
php artisan migrate
php artisan serve
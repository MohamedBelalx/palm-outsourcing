# 🔁 Proxy Rotator Microservice (Go 1.20.7)

This is a simple, lightweight Golang microservice that serves rotating proxy IPs to support the Laravel scraper in the Jumia scraping system. It randomly returns a working proxy from a defined pool via an HTTP endpoint.

---

## 🚀 Purpose

When scraping websites like Jumia, rotating through proxy IPs helps avoid detection, IP bans, and rate limits. This service runs separately and returns a random proxy via:

GET http://localhost:8081/proxy


It can be consumed easily from Laravel (or any HTTP client) to dynamically assign proxies during scraping requests.

---

## 📂 Folder Structure
```
proxy-golang/
├── main.go # HTTP server that responds to /proxy 
├── proxy.go # Proxy pool logic and randomization 
├── go.mod # Module definition (Go 1.20.7) 
└── README.md # You're here
```

---

## ⚙️ Setup Instructions

### 1. Prerequisites

- Go 1.20.7 installed (check with `go version`)
- Terminal access

### 2. Run the Service

```bash
cd proxy-golang
go mod tidy
go run main.go proxy.go
You should see:

✅ Proxy service is running on http://localhost:8081
🧪 Test It
In a separate terminal:

bash
curl http://localhost:8081/proxy
Response:

json
{ "proxy": "http://51.158.68.68:8811" }
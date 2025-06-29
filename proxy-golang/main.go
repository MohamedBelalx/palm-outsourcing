// main.go
package main

import (
    "encoding/json"
    "log"
    "net/http"
)

type ProxyResponse struct {
    Proxy string `json:"proxy"`
}

func main() {
    http.HandleFunc("/proxy", func(w http.ResponseWriter, r *http.Request) {
        proxy := GetRandomProxy()
        response := ProxyResponse{Proxy: proxy}

        w.Header().Set("Content-Type", "application/json")
        json.NewEncoder(w).Encode(response)
    })

    log.Println("✅ Proxy service is running on http://localhost:8081")
    log.Fatal(http.ListenAndServe(":8081", nil))
}

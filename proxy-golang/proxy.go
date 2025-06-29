// proxy.go
package main

import (
    "math/rand"
    "sync"
    "time"
)

var (
    proxies = []string{
		"http://139.59.1.14:80",
		"http://51.81.245.3:17981",
// 		  "http://51.158.68.68:8811",
//   "http://45.77.76.121:3128",
        // "http://192.168.1.101:8080",
        // "http://192.168.1.102:8080",
        // "http://192.168.1.103:8080",
        // "http://192.168.1.104:8080",
    }

    mu sync.Mutex
)

func GetRandomProxy() string {
    mu.Lock()
    defer mu.Unlock()

    rand.Seed(time.Now().UnixNano())
    return proxies[rand.Intn(len(proxies))]
}

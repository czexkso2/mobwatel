self.addEventListener("install", function (event) {
  event.waitUntil(
    caches.open("demob-cache-v1").then(function (cache) {
      return cache.addAll([
        "/",
        "/index.php",
        "/styles.css",
        "/manifest.json"
        // Dodaj tu inne pliki, jeśli chcesz je cache'ować, np.:
        // "/dashboard.php", "/login.php", "/images/icon-192.png"
      ]);
    })
  );
});

self.addEventListener("fetch", function (event) {
  event.respondWith(
    caches.match(event.request).then(function (response) {
      return response || fetch(event.request);
    })
  );
});

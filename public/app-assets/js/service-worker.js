// Service Worker
const cacheName = "mini-show-pwa";

// url name
const filesToCache = [
    "/app-assets/css/poppins.css",
    "/app-assets/css/slick.css",
    "/app-assets/css/bootstrap.min.css",
    "/app-assets/js/popper.min.js",
    "/app-assets/js/bootstrap2.min.js",
    "/app-assets/js/feather.min.js",

    "/app-assets/js/jquery-3.5.1.js",
    "/app-assets/js/bootstrap.bundle.min.js",
    "/app-assets/js/slick.min.js",
    "/app-assets/js/bootstrap-notify.min.js",
    "/app-assets/js/notify-script.js",

    "/",
    "/checkout",
];

self.addEventListener("install", e => {
    console.log("[ServiceWorker**] Install");
    e.waitUntil(
        caches.open(cacheName).then(cache => {
            console.log("[ServiceWorker**] Caching app shell");
            return cache.addAll(filesToCache);
        })
    );
});
self.addEventListener("activate", event => {
    caches.keys().then(keyList => {
        return Promise.all(
        keyList.map(key => {
            if (key !== cacheName) {
            console.log("[ServiceWorker] - Removing old cache", key);
            return caches.delete(key);
            }
        })
        );
    });
});
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request, { ignoreSearch: true }).then(response => {
        return response || fetch(event.request);
        })
    );
});

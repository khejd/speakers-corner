const CACHE_NAME = 'speak-v1';
let urlsToCache = [
    '/',
    '/static/',
    '/phone/',
    '/comment/',
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css'
];

self.addEventListener('install', (event) => {
    // Perform install steps
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                cache.addAll(urlsToCache.map((url) => {
                    return new Request(url, { mode: 'no-cors' });
                }));
            })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        // Try the cache
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        }).catch(() => {
            // Do nothing
        })
    );
});

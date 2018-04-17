const CACHE_NAME = 'speak-v1';
let urlsToCache = [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css',
    'index.html',
    '/static/css/app.css',
    '/phone/index.html',
    '/comment/index.html'
];

self.addEventListener('install', (event) => {
    // Perform install steps
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                cache.addAll(urlsToCache.map((url) => {
                    const REQUEST =  new Request(url, { mode: 'no-cors' });
                    fetch(REQUEST).then((response) => cache.put(REQUEST, response));
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

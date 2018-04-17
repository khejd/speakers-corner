const CACHE_NAME = 'speak-v1';
let urlsToCache = [
    '/static/',
    '/comment/index.html',
    '/phone/index.html',
    '/speak/index.html',
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
    'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js'
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

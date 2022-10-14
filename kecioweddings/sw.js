const staticCacheName = 'site-static';
const assets = [
  '/',
  '/index.php',
  '/js/app.js',
  '/assets/css/base.css',
  'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css',
  '/jquery.php',
  '/home.php',
  '/menu.php',
  '/side-menu.php',
  '/images/native/IMG_6351.jpg',
  '/images/native/logo/weblogo.png',
  '/images/native/logo/mobilelogo.png'
  
]; 
//install service worker
self.addEventListener('install', evt => {
  //console.log('service worker installed');
  evt.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      console.log('caching shell assets');
      cache.addAll(assets);
    })
  ); 
});

// activate event
self.addEventListener('activate', evt=> {
//  console.log('service worker activated');
});

// fetch evetnts
self.addEventListener('fetch', evt=> {
     //console.log('fetch event',evt);
     evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request);
    })
  ); 
});
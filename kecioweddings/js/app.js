if('serviceWorker' in navigator) {
  navigator.serviceWorker.register('sw.js')
          .then((reg) =>console.log('Registration succeeded. Scope is',reg)) // promise
          .catch((err) => console.log('service worker not registered',err));
       
    
    
};



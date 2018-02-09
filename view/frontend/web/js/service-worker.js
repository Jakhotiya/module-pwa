importScripts(location.href.replace('service-worker.js', 'localforage.js'));

/**
 * Version cache using mechanism similar to magento
 *
 */
var cacheName = 'store-v1';

/**
 * cache resources on install
 */

const BASE_URL = this.registration.scope;

self.addEventListener('install', (evt) => {
  console.log('installing service worker');
});


function getEndpoint() {
  return self.registration.pushManager.getSubscription()
    .then(function (subscription) {
      if (subscription) {
        return subscription.endpoint;
      }

      throw new Error('User not subscribed');
    });
}


self.addEventListener('push', function (event) {
console.log('push event recieved');
  event.waitUntil(
    getEndpoint()
      .then(function (endpoint) {
        return fetch(BASE_URL + 'pwa/notification/get?endpoint=' + endpoint);
      }).then(function (response) {
      return response.json();
    }).then(function (payload) {

      self.registration.showNotification(payload.title, {
        body: payload.body,
      })
    })
  );
});




  self.addEventListener('notificationclick', function (event) {
    console.log('[Service Worker] Notification click Received.');

    event.notification.close();

    event.waitUntil(
      clients.openWindow('https://developers.google.com/web/')
    );
  });

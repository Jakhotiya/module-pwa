define(['jquery'], function ($) {

    return function (config) {

        const applicationServerPublicKey = config.applicationPubKey;

        const postUrl = config.postUrl;

        var isSubscribed = false;

        var swRegistration = null;


        if ('serviceWorker' in navigator) {


            /**
             * Register service worker on load. Also check if user is subscribed or not
             */
            function registerServiceWorker(){
                navigator.serviceWorker.register(config.swUrl, {scope: '/'})
                    .then(function (registration) {
                        // Registration was successful
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);

                        swRegistration = registration;

                        registration.pushManager.getSubscription()
                            .then(function (subscription) {
                                isSubscribed = !(subscription === null);
                                if (isSubscribed) {
                                    console.log('User IS subscribed.');
                                } else {
                                    console.log('User is NOT subscribed.');
                                }
                            });

                    }, function (err) {
                        // registration failed :(
                        console.log('ServiceWorker registration failed: ', err);
                    });
            }


            /**
             * Subscribe user call. On calling this function browser will
             * ask user for notification permissions
             */
            function subscribeUser() {

                const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);

                swRegistration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: applicationServerKey
                }).then(function (subscription) {
                    console.log('User is subscribed.');
                    updateSubscriptionOnServer(subscription);
                })
                    .catch(function (err) {
                        console.log('Failed to subscribe the user: ', err);
                    });
            }


            /**
             * Send subscription details to magento server
             *
             * @param subscription
             */
            function updateSubscriptionOnServer(subscription){
                isSubscribed = true;
                var data = {
                    'endpoint':subscription.endpoint,
                    'user_agent':navigator.userAgent
                };

                $.post(postUrl,data,function(response){
                    console.log(response);
                });
                console.log(subscription);

            }


            /**
             * Convert base64 string to Uint8Array format required subscribe API
             */

            function urlB64ToUint8Array(base64String) {
                const padding = '='.repeat((4 - base64String.length % 4) % 4);
                const base64 = (base64String + padding)
                    .replace(/\-/g, '+')
                    .replace(/_/g, '/');

                const rawData = window.atob(base64);
                const outputArray = new Uint8Array(rawData.length);

                for (var i = 0; i < rawData.length; ++i) {
                    outputArray[i] = rawData.charCodeAt(i);
                }
                return outputArray;
            }

            registerServiceWorker();

            if(!isSubscribed){
                $('.welcome').click(subscribeUser);
            }

        }



    }
});
## Progressive Web App for Magento2 stores ##

**Module depends on ext-gmp for push notifications**

### Things this module attempts to do ###

1. Push notifications
2. Web manifest.json for add to home screen feature
3. Service worker cache for increased percieved speed of the website.

I'll try to document above ideas in as detail as possible. Some of the stuff like caching strategy is 
going to be an continous evolution.

### Service workers and  setting up their scope ###

Service workers are served from static folder hence there scope will
look something like <magento store url>/static/version/<path to theme>/Magecrafts_WebApp/js/ .

This scope is inadequet for all the tasks we want to accomplish with our store. We would like
to intercept network calls to our html pages too so our scope should be <store url>.
On my local machine that looks like https://mage.dev
 
*ServiceWorker registration successful with scope:  https://mage.dev/*

is the message that should be shown by browser. To access scope like that we need to add 
**add_header "Service-Worker-Allowed" "/";** to nginx.conf. This response header must be
present in response to a service-worker JavaScript request.






/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue'
import router from './components/router/routes'
import Layouts from './components/pages'
import VueResource from 'vue-resource'
import VueLazyload from 'vue-lazyload'
import VueSweetalert2 from 'vue-sweetalert2'
import BootstrapVue from 'bootstrap-vue'
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)
Vue.use(BootstrapVue)
Vue.use(VueSweetalert2)  
Vue.use(VueLazyload)
Vue.use(VueResource)
Vue.use(Layouts)
Vue.component('api-calling', require('./components/Home.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app',
//      router,
// });
const app = new Vue({
    el: '#app',
    router,
});
// ---SW PRECACHE
// if ('serviceWorker' in navigator) {
//     // Your service-worker.js *must* be located at the top-level directory relative to your site.
//     // It won't be able to control pages unless it's located at the same level or higher than them.
//     // *Don't* register service worker file in, e.g., a scripts/ sub-directory!
//     // See https://github.com/slightlyoff/ServiceWorker/issues/468
//     navigator.serviceWorker.register('/service-worker.js').then(function(reg) {
//         // updatefound is fired if service-worker.js changes.
//         reg.onupdatefound = function() {
//             // The updatefound event implies that reg.installing is set; see
//             // https://slightlyoff.github.io/ServiceWorker/spec/service_worker/index.html#service-worker-container-updatefound-event
//             var installingWorker = reg.installing;

//             installingWorker.onstatechange = function() {
//                 switch (installingWorker.state) {
//                     case 'installed':
//                         if (navigator.serviceWorker.controller) {
//                             // At this point, the old content will have been purged and the fresh content will
//                             // have been added to the cache.
//                             // It's the perfect time to display a "New content is available; please refresh."
//                             // message in the page's interface.
//                             console.log('New or updated content is available.');
//                         } else {
//                             // At this point, everything has been precached.
//                             // It's the perfect time to display a "Content is cached for offline use." message.
//                             console.log('Content is now available offline!');
//                         }
//                         break;

//                     case 'redundant':
//                         console.error('The installing service worker became redundant.');
//                         break;
//                 }
//             };
//         };
//     }).catch(function(e) {
//         console.error('Error during service worker registration:', e);
//     });
// }
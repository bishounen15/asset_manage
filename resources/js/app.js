/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-dataset', require('./components/admin/UserDataset.vue').default);

Vue.component('dept-dataset', require('./components/setup/DeptDataset.vue').default);
Vue.component('site-dataset', require('./components/setup/SiteDataset.vue').default);
Vue.component('assettype-dataset', require('./components/setup/AssetTypeDataset.vue').default);
Vue.component('proptype-dataset', require('./components/setup/PropertyTypeDataset.vue').default);
Vue.component('assetstatus-dataset', require('./components/setup/AssetStatusDataset.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

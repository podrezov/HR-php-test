window.Vue = require('vue');


Vue.component('example', require('./components/Example.vue'));
Vue.component('editPriceProduct', require('./components/products/edit-price-product'));
Vue.component('ordersComponent', require('./components/OrdersComponent'));

const app = new Vue({
    el: '#app',
});
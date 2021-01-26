require('./bootstrap');

require('alpinejs');
window.Vue = require('vue').default;

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('books-collection-component', require('./components/includes/BooksCollectionComponent.vue').default);

const app = new Vue({
    el: '#app',
});

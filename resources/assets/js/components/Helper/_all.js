window.Vue = require('vue');

Vue.component('example-component', require('../ExampleComponent.vue').default);
Vue.component('pagination-component', require('./PaginationComponent.vue').default);
Vue.component('pagination', require('./bootstrap/Pagination.vue').default);
// Vue.component('moment-live', require('./MomentLive.vue').default);
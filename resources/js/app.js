require('materialize-css');

window.Vue = require('vue');
window.App = require('./components/App.vue');
window.axios = require('axios');

const app = new Vue({
    render: h => h(App),
}).$mount('#app');

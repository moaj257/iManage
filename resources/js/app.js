import Vue from 'vue';
import router from './router/index';
import { ServerTable } from 'vue-tables-2';

import App from './index.vue';

Vue.use(ServerTable);

new Vue({
    router,
    render: h => h(App)
}).$mount('#app');
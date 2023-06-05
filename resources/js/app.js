require('./bootstrap');
window.Vue = require('vue').default;
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

import router from './router'
Vue.use(Vuetify,{
    icons: {
        iconfont: 'mdi',
    },
});
const app = new Vue({
    el: '#app',
    router:router,
    vuetify: new Vuetify(),
});

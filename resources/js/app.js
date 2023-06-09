require('./bootstrap');
window.Vue = require('vue').default;
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

console.log(window.baseIMAGE_URL)
import router from './router'
import store from './store'

Vue.use(Vuetify,{
    icons: {
        iconfont: 'mdi',
    },
});
const app = new Vue({
    el: '#app',
    router:router,
    store:store,
    vuetify: new Vuetify(),
});

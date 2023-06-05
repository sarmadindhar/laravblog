import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const Login = () => import('../components/Login.vue')
const Register = () => import('../components/Register.vue')
const MasterLayout = () => import('../components/Layouts/MasterLayout.vue')
const HomePage = () => import('../components/HomePage.vue')

const Routes = [
    {
        name:"login",
        path:"/login",
        component:Login,
    },
    {
        name:"register",
        path:"/register",
        component:Register,

    },
    {
        path:"/",
        component:MasterLayout,
        children:[
            {
                name:"home",
                path: '/',
                component: HomePage,
            }
        ]
    }
];


var router  = new VueRouter({
    mode: 'history',
    routes: Routes
})


export default router

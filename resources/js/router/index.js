import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)

const Login = () => import('../components/Login.vue')
const Register = () => import('../components/Register.vue')
const MasterLayout = () => import('../components/Layouts/MasterLayout.vue')
const HomePage = () => import('../components/HomePage.vue')
const CreatePost = () => import('../components/CreatePost.vue')

const Routes = [
    {
        name:"login",
        path:"/login",
        component:Login,
        meta:{
            title:"Login",
            middleware:"public",
        }
    },
    {
        name:"register",
        path:"/register",
        component:Register,
        meta:{
            title:"Register",
            middleware:"public",
        }

    },
    {
        path:"/",
        component:MasterLayout,
        children:[
            {
                name:"home",
                path: '/',
                component: HomePage,
                meta:{
                    title:"Home",
                    middleware:"protected",
                }
            }
        ]
    },
    {
        path:"/post",
        component:MasterLayout,
        children:[
            {
                name:"post",
                path: '/post',
                component: CreatePost,
                meta:{
                    title:"Create Post",
                    middleware:"private",
                }
            }
        ]
    }
];


var router  = new VueRouter({
    mode: 'history',
    routes: Routes
})

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} `
    if(to.meta.middleware=="public"){
        if(store.state.auth.authenticated){
            next({name:"home"})
        }
        next()
    }else if(to.meta.middleware ==="protected"){
        next()
    }
    else{
        if(store.state.auth.authenticated){
            next()
        }else{
            next({name:"login"})
        }
    }
})

export default router

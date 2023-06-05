import axios from 'axios'
import router from '../router'


export default {
    state:{
        authenticated:false,
        user:{}
    },

    getters:{
        authenticated: state => state.authenticated,
        user: state => state.user,
    },

    mutations:{
        setAuthenticated (state, value) {
            state.authenticated = value
        },
        setUser (state, value) {
            state.user = value
        }
    },


    actions:{
        loginUser({commit},params){
            return axios.get('/api/user').then(({data})=>{
                commit('setUser',data)
                commit('setAuthenticated',true)
                router.push({name:'home'})
            }).catch(({response:{data}})=>{
                commit('setUser',{})
                commit('setAuthenticated',false)
            })
        },


        signOut({commit}){
            commit('setUser',{})
            commit('setAuthenticated',false)
            router.push({name:'login'})
        }
    }
}

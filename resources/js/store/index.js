import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import post from './post'

Vue.use(Vuex)

export default new Vuex.Store({
    plugins:[
        createPersistedState()
    ],
    modules:{
        post
    }
})

<template>
    <v-app>
        <v-app-bar app>
            <v-toolbar-title>Lara-V-Blog</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn to="/post" v-if="authenticated">Add Post</v-btn>
            <v-btn text @click="logout" v-if="authenticated">Logout</v-btn>
            <v-btn to="/login" v-if="!authenticated">
                Login
            </v-btn>
        </v-app-bar>
        <v-main>
            <v-container>
                <!-- Your page content goes here -->
                <router-view></router-view>

            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import router from "../../router";
import {mapActions} from "vuex";

export default {
    data() {
        return {
            user:this.$store.state.auth.user,
            authenticated:this.$store.state.auth.authenticated,
        };
    },
    methods:{
        ...mapActions(['signOut']),
        async logout(){
            await axios.post('/logout').then(({data})=>{
                this.signOut()
            })
        },
        loginRedirect(){
            router.push({name:'login'})
        },

    }
};
</script>

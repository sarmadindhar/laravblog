<template>
    <v-app>
        <v-app-bar app>
            <v-toolbar-title>LARA-VUE</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text @click="logout" v-if="authenticated">Add Post</v-btn>
            <v-btn text @click="logout" v-if="authenticated">Logout</v-btn>
            <v-btn text @click="loginRedirect" v-if="!authenticated">
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
export default {
    data() {
        return {
            user:{id:1,name:"sarmad"},
            authenticated:true,
        };
    },
    methods:{
        async logout(){
            router.push({name:'login'})
        },
        loginRedirect(){
            router.push({name:'login'})
        }

    }
};
</script>

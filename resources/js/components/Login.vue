<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6">
                <v-card class="mt-15">
                    <v-card-title class="text-center">
                        <h2>Login</h2>
                    </v-card-title>
                    <v-card-text>
                        <v-form ref="form" @submit.prevent="login">
                            <v-text-field v-model="auth.email" label="Email" type="email" outlined required></v-text-field>
                            <v-text-field v-model="auth.password" label="Password" type="password" outlined required></v-text-field>
                            <v-btn type="submit" color="primary" block :disabled="processing" >
                                {{ processing ? "Please wait" : "Login" }}
                            </v-btn>
                        </v-form>
                    </v-card-text>
                    <v-card-actions class="text-center">
                        <p>Don't have an account? <router-link to="/register">Register</router-link></p>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    data() {
        return {
            auth:{
                email:"",
                password:""
            },
            processing:false
        }
    },
    methods: {
        ...mapActions(['loginUser']),
        async login(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login',this.auth).then(({data})=>{
                console.log(data)
                this.loginUser()
            }).catch(({response:{data}})=>{
                console.log(data)
                alert(data.message)
            }).finally((e)=>{
                this.processing = false
                console.log(e)
            })
        },
    }
};
</script>

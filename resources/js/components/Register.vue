<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6">
                <v-card>
                    <v-card-title class="text-center">
                        <h2>Register</h2>
                    </v-card-title>
                    <v-card-text>
                        <v-form ref="form" @submit.prevent="register">
                            <v-text-field v-model="user.name" label="Name" type="text" outlined required></v-text-field>
                            <v-text-field v-model="user.email" label="Email" type="email" outlined required></v-text-field>
                            <v-text-field v-model="user.password" label="Password" type="password" outlined required></v-text-field>
                            <v-text-field v-model="user.password_confirmation" label="Password" type="password" outlined required></v-text-field>
                            <v-btn type="submit" color="primary" block :disabled="processing" >
                                {{ processing ? "Please wait" : "Register" }}
                            </v-btn>

                        </v-form>
                    </v-card-text>
                    <v-card-actions class="text-center">
                        <p>Already have an account? <router-link to="/login">Login</router-link></p>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:""
            },
            processing:false
        };
    },
    methods:{

    }
};
</script>

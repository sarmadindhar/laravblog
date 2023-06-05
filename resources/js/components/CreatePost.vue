<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="8">
                <v-form  @submit.prevent="addNewPost">
                    <v-text-field v-model="post.title" label="Title"></v-text-field>
                    <v-textarea v-model="post.content" label="Content"></v-textarea>
                    <v-file-input
                        v-model="post.image"
                        label="Image"
                        accept="image/*"
                    ></v-file-input>
                    <v-btn type="submit" color="primary" block :disabled="processing" >
                        {{ processing ? "Please wait" : "Save" }}
                    </v-btn>

                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import router from "../router";

export default {
    data() {
        return {
            post:{
                title: '',
                content: '',
                image: null,
            },
            processing:false
        };
    },
    methods: {
        async addNewPost(){
            this.processing = true
            const formData = new FormData();
            formData.append('image', this.post.image);
            formData.append('title', this.post.title);
            formData.append('content', this.post.content);
            await axios.post('/api/post',formData).then(response=>{
                console.log(response)
            }).catch(({response:{data}})=>{
                alert(data.message)
            }).finally(()=>{
                this.processing = false
                router.push({name:'home'})
            })
        }
    },
};
</script>
